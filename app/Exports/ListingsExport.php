<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ListingsExport implements FromCollection
{
    protected $listings;

    public function __construct($listings)
    {
        $this->listings = $listings;
    }

    public function collection()
    {
        return $this->listings;
    }
}
