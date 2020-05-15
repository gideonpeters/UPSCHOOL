<?php

namespace App\Observers;

use App\Admin;

class AdminObserver
{

    public function created(Admin $admin)
    {
        //
    }


    public function updated(Admin $admin)
    {
        //
    }

    public function deleted(Admin $admin)
    {
        //
        $user = $admin->user;

        if ($user) $user->delete();
    }

    public function restored(Admin $admin)
    {
        //
    }

    public function forceDeleted(Admin $admin)
    {
        //
    }
}
