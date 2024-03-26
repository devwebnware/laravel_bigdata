<?php

namespace App\Traits;

use App\Models\Expense;

trait Expenses
{
    public function updateStatus($id, $status, $payment_date, $payment_mode)
    {
        $expense = Expense::where('id', $id)->first();
        $expense->status = $status;
        if ($payment_date) {
            $expense->payment_date  = $payment_date;
            $expense->payment_mode  = $payment_mode;
        } else {
            $expense->authorised_by = auth()->user()->id;
            $expense->payment_date  = null;
            $expense->payment_mode  = null;
        }
        if ($expense->save()) {
            return response()->json(['success' => 'Status Changed Successfully.']);
        } else {
            return response()->json(['error' => 'An error occurred.']);
        }
    }
}
