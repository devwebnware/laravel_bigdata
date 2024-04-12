<?php

namespace App\Imports;

use App\Models\Listing;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class CSVImport implements ToCollection
{
    protected $mappingData;

    public function __construct($mappingData)
    {
        $this->mappingData = $mappingData;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $this->processRow($row);
        }
    }

    protected function processRow($row)
    {
        $listing = Listing::where('name', $row[$this->mappingData['name']])->first();

        if ($listing) {
            $this->updateListing($listing, $row);
        } else {
            $this->createListing($row);
        }
    }

    protected function updateListing($listing, $row)
    {
        foreach ($this->mappingData as $key => $value) {
            if (isset($row[$key])) {
                $listing->$value = $row[$key];
            }
        }

        $listing->save();
    }

    protected function createListing($row)
    {
        $listing = new Listing();

        foreach ($this->mappingData as $key => $value) {
            if (isset($row[$key])) {
                $listing->$value = $row[$key];
            }
        }

        $listing->save();
    }

    public function chunkSize(): int
    {
        return 100; // Change chunk size according to your needs.
    }
}
