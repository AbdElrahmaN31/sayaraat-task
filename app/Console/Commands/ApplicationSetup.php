<?php

namespace App\Console\Commands;

use Config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ApplicationSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '🌱 Setup the application with one simple command 🌱';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        ini_set('memory_limit', '2048M');
        $this->warn("·· Setting up your application 🤸");
        exec('composer dump-autoload');
        exec('composer install --ignore-platform-reqs --no-scripts --no-interaction --no-dev --prefer-dist');
        $this->info("Composer installed");
        // Clear app cache.
        $this->callSilent('optimize:clear');
        // Optimize app cache.
        $this->call('optimize');
        $this->info("cache optimized");

        if (!App::environment('production')) {
            $this->info("App in " . app()->environment() . " environment.");
            // 00.Turn off foreign key check
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            // 01.Clear DB
            $dbConnectionName = Config::get('database.default');
            $this->call("db:wipe", ['--database' => $dbConnectionName]);
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $this->call('migrate:fresh');
            $this->info("  Database Migration is Done");
            // 02. Seed database with dummy data
            $this->warn("·· Dummy Data is being generated");
            $this->call('db:seed');
            // 03.Turn foreign key check back on
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        } else {
            $this->info("App in production environment");
            $this->call('migrate');
            $this->info("New database tables migrated");
        }
        $this->comment("  All Done 🎉");
    }
}

