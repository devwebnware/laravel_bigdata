<?php

namespace App\Exports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\FromCollection;

class ListingsExport implements FromCollection
{
    public function collection()
    {
        return Listing::all();
    }
}