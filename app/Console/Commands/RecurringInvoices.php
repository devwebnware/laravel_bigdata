<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoices\Invoice;
use App\Models\Invoices\InvoiceItem;
use App\Models\Recurring;
use Carbon\Carbon;

class RecurringInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command for invoice recurring';

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
        $invoiceNumber = Invoice::where('status', 3)->latest('invoice_number')->select('invoice_number')->first();
        if ($invoiceNumber) {
            $invoiceNo = ++$invoiceNumber->invoice_number;
        }
        $invoices = Invoice::where('status', 3)->where('renewal_date', Carbon::now())->get();
        foreach ($invoices as $invoice) {
            if ($invoice->renewal_date == Carbon::now()) {
                $recurring = Recurring::where('invoice_id', $invoice->id)->first();
                if ($recurring) {
                    $recurringTime = $recurring->recurring_time_value;
                    $recurringTimeType = $recurring->recurring_time_type;
                    $recurringStartDate = $recurring->start_date;
                    if ($recurringTimeType == "week") {
                        $renewalDate = Carbon::create($recurringStartDate)->addWeek($recurringTime);
                    } elseif ($recurringTimeType == "month") {
                        $renewalDate = Carbon::create($recurringStartDate)->addMonth($recurringTime);
                    } elseif ($recurringTimeType == "year") {
                        $renewalDate = Carbon::create($recurringStartDate)->addYear($recurringTime);
                    } else {
                        $renewalDate = Carbon::create($recurringStartDate)->addDay($recurringTime);
                    }
                    $newInvoice = new Invoice([
                        "company_id" => $invoice->company_id,
                        "client_id" => $invoice->client_id ?? '1',
                        "invoice_number" => $invoiceNo,
                        "invoice_date" => $invoice->invoice_date,
                        "sub_total" => $invoice->sub_total,
                        "tax_type" => $invoice->tax_type,
                        "gst_percentage" => $invoice->gst_percentage,
                        "tax_amount" => $invoice->tax_amount,
                        "discount" => $invoice->discount ?? '0',
                        "grand_total" => $invoice->grand_total,
                        "status" => 3,
                        "renewal_date" => $renewalDate,
                    ]);
                    $invoiceItems = InvoiceItem::where('invoice_id', $invoice->id)->get();
                    foreach ($invoiceItems as $item) {
                        for ($flag = 0; $flag < count($invoiceItems->items['item']); $flag++) {
                            $invoiceItems = new InvoiceItem([
                                'invoice_id' => $invoices->id,
                                'item' => $item->items['item'][$flag],
                                'details' => $item->items['details'][$flag],
                                'hsn' => $item->items['hsn'][$flag],
                                'price' => $item->items['price'][$flag],
                                'quantity' => $item->items['quantity'][$flag],
                                'total' => $item->items['total'][$flag],
                            ]);
                            $invoiceItems->save();
                        }
                    }
                    $invoice->renewal_date = null;
                    if ($invoice->save()) {
                        $recurring->start_date = Carbon::now();
                        $recurring->invoice_id = $newInvoice->id;
                        $recurring->update();
                    }
                }
            }
        }
    }
}
