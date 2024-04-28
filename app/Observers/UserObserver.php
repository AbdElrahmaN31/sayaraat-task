<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{
    public function creating(User $row)
    {
        // if the user is employee set his manager id
        if ($row->role === 'employee') {
            $row->manager_id = $row->department?->manager_id;
        }
    }

    public function updating(User $row)
    {
        if (request()->has('image')) {
            if ($row->getRawOriginal('image') != 'assets/images/placeholder.png' && $row->getRawOriginal('image') != null) {
                Storage::delete($row->getRawOriginal('image'));
            }
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $row
     * @return void
     */
    public function deleted(User $row)
    {
        if ($row->getRawOriginal('image') != 'assets/images/placeholder.png' && $row->getRawOriginal('image') != null) {

            Storage::delete($row->getRawOriginal('image'));
        }
    }

}
