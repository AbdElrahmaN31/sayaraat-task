<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::employees()->each(function ($employee) {
            Task::factory()->times(5)->create([
                'employee_id'   => $employee->id,
                'manager_id'    => $employee->manager_id,
                'department_id' => $employee->department_id,
            ]);
        });
    }
}
