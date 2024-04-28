<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Seeder;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departmentsNames = ['TECH', 'Finance', 'HR'];
        foreach ($departmentsNames as $departmentName) {

            $department = Department::factory()->create([
                'name'       => $departmentName,
                'manager_id' => User::factory()->manager()->create()->id
            ]);

            // create 5 employees for each department
            User::factory()->employee()->times(5)->create([
                'department_id' => $department->id,
                'manager_id'    => $department->manager_id,
                'salary'        => floatval(fake()->numberBetween(5, 10) * 1000),
            ]);
        }
    }
}
