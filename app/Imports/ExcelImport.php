<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    protected $firstRow;

    public function collection(Collection $collection)
    {
        $this->firstRow = $collection->first(); // Retrieve the first row
    }

    public function getFirstRow()
    {
        return $this->firstRow;
    }
}
