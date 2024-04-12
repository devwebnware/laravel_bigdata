<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ImportJobStart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $jobStatusId;

    public function __construct($jobStatusId)
    {
       $this->jobStatusId = $jobStatusId;
    }
}
