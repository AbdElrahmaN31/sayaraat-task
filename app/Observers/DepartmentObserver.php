<?php

namespace App\Observers;

use App\Models\Department;

class DepartmentObserver
{
    public function updated(Department $row)
    {
        if ($row->getRawOriginal('manager_id') != $row->manager_id) {
            $row->employees()->update(['manager_id' => $row->manager_id]);
        }
    }
}
