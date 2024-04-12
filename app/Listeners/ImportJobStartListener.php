<?php

namespace App\Listeners;

use App\Events\ImportJobStart;
use App\Models\ImportJobStatus;

class ImportJobStartListener
{
    public function __construct()
    {
        //
    }

    public function handle(ImportJobStart $event)
    {
        $this->updateStatus($event->jobStatusId);
    }

    public function updateStatus($jobStatusId)
    {
        $jobStatus = ImportJobStatus::find($jobStatusId);
        if ($jobStatus) {
            $jobStatus->status = 0; // '0' represents 'in progress' status
            $jobStatus->save();
        }
    }
}
