<?php

namespace App\Console\Commands;

use App\Models\ConnectionReminder;
use App\Models\LeadReminder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReminderNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder-notification-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan Command To Send Daily Reminder Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::where('deleted_at', null)->get();
        foreach ($users as $user) {
            $connectionReminder = ConnectionReminder::whereDate('date', Carbon::now()->format('Y-m-d'))->where('assigned_to', $user->id)->orderBy('time', 'asc')->get();
            $leadReminder = LeadReminder::whereDate('date', Carbon::now()->format('Y-m-d'))->where('assigned_to', $user->id)->orderBy('time', 'asc')->get();
            if (count($connectionReminder) > 0 || count($leadReminder) > 0) {
                $data = ['connectionReminder' => $connectionReminder, 'leadReminder' => $leadReminder, 'user' => $user];
                Mail::send('backend.emails.followUpReminder', $data, function ($message) use ($user) {
                    $message->to($user->email);
                    $message->subject("Today's All Scheduled Follow Up's");
                });
            }
        }
    }
}