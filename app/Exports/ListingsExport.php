<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListingsExport implements FromCollection, WithHeadings
{
    protected $listings;
    protected $columnNames;

    public function __construct($listings, $columnNames=null)
    {
        $this->listings = $listings;
        $this->columnNames = $columnNames;
    }

    public function collection()
    {
        return $this->listings;
    }
    
    public function headings(): array
    {
        return $this->columnNames;
    }
}
