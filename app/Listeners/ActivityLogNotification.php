<?php

namespace App\Listeners;

use App\Events\ActivityLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivityLogNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ActivityLog $data)
    {
        $this->createLog($data);
    }
    public function createLog($data)
    {
        $report = $data->details;
        $activity = DB::table('activity_logs')->insert(
            [
                'message'  => $report['message'],
                'type'  => $report['type'],
                'sender_id'  => $report['sender_id'],
                'receiver_id'  => $report['receiver_id'],
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]
        );
        return $activity;
    }
}
