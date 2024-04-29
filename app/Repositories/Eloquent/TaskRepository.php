<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Interfaces\ITaskRepository;

class TaskRepository extends BaseRepository implements ITaskRepository
{
    public function __construct()
    {
        $this->model = new Task();
    }
}
