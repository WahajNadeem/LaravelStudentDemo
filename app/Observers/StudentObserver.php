<?php

namespace App\Observers;

use App\Models\Student;
use Illuminate\Support\Facades\Cache;
class StudentObserver
{
    /**
     * Handle the Student "created" event.
     */

    protected function clearCache()
    {
        Cache::forget('students_all');
    }
    public function created(Student $student): void
    {
       $this->clearCache();
    }

    /**
     * Handle the Student "updated" event.
     */
    public function updated(Student $student): void
    {
       $this->clearCache();
    }

    /**
     * Handle the Student "deleted" event.
     */
    public function deleted(Student $student): void
    {
       $this->clearCache();
    }

    /**
     * Handle the Student "restored" event.
     */
    public function restored(Student $student): void
    {
       $this->clearCache();
    }

    /**
     * Handle the Student "force deleted" event.
     */
    public function forceDeleted(Student $student): void
    {
       $this->clearCache();
    }
}
