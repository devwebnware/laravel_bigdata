<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ListingsExport implements FromCollection, WithHeadings
{
    protected $listings;
    protected $columnNames;

    public function __construct($listings, $columnNames = null)
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
        if ($this->columnNames) {
            return $this->columnNames;
        }

        // If $columnNames is not set, extract column names from the first item of the collection and return them
        $this->columnNames = array_keys($this->listings->first()->getAttributes());
        return $this->columnNames;
    }
}
