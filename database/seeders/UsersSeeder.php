<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createUser('admin', 'admin@gmail.com', '201010101010', 'admin');
        $manager = $this->createUser('manager', 'manger@gmail.com', '201010101011', 'manager', 1);
        $this->createUser('user', 'user@gmail.com', '201010101012', 'employee', 1, $manager->id);
    }

    private function createUser($last_name, $email, $phone, $role, $department_id = null, $manager_id = null)
    {
        return User::query()->updateOrCreate([
            'email' => $email,
        ], [
            'first_name'    => 'System',
            'last_name'     => $last_name,
            'email'         => $email,
            'phone'         => $phone,
            'password'      => 'Aa@123456',
            'role'          => $role,
            'department_id' => $department_id,
            'manager_id'     => $manager_id,
        ]);
    }
}
