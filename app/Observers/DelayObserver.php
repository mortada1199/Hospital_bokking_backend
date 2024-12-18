<?php

namespace App\Observers;

use App\Models\Patient;
use App\Notifications\DelayInInterview;
use Carbon\Carbon;

class DelayObserver
{
    /**
     * Handle the Patient "created" event.
     */
    public function created(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "updated" event.
     */
    public function updated(Patient $patient): void
    {
         $pa = Patient::find('4');//patient 4

        if($pa['status']=="InActive"){
          $patient->notify(new DelayInInterview);
        }
    }

    /**
     * Handle the Patient "deleted" event.
     */
    public function deleted(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "restored" event.
     */
    public function restored(Patient $patient): void
    {
        //
    }

    /**
     * Handle the Patient "force deleted" event.
     */
    public function forceDeleted(Patient $patient): void
    {
        //
    }
}
