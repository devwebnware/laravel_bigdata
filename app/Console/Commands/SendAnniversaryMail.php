<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendAnniversaryMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:anniversaryMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Birthday and Work Anniversary Wish Email';

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
        $employees = Employee::where('status', '1')->where('is_hidden', '0')->get();
        foreach ($employees as $employee) {
            if (Carbon::parse($employee->joining_date)->parse('d-m') == Carbon::now()->format('d-m')) {
                sendWorkAnniversaryEmail($employee);
            }
            if (Carbon::parse($employee->dob)->parse('d-m') == Carbon::now()->format('d-m')) {
                sendBirthdayWishEmail($employee);
            }
        }
    }
}
