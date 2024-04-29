<?php

namespace App\Repositories\Eloquent;

use App\Models\Department;
use App\Repositories\Interfaces\IDepartmentRepository;

class DepartmentRepository extends BaseRepository implements IDepartmentRepository
{
    public function __construct()
    {
        $this->model = new Department();
    }
}
