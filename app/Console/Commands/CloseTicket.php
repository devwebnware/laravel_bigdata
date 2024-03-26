<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CloseTicket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'close:ticket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $lastWeekRequests = Ticket::where('created_at', '<', Carbon::now()->subDays(7))->where('status', '0')->get();
        foreach ($lastWeekRequests as $ticket) {
            $ticket->status = 2;
            $ticket->update();
        }
    }
}
