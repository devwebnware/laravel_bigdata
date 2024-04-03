<?php

namespace App\Jobs;

use App\Models\Listing;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;


class ImportDataJob implements ToModel, WithChunkReading, ShouldQueue, WithHeadingRow
{
    protected $mappingData;

    public function __construct($mappingData)
    {
        $this->mappingData = $mappingData;
    }

    public function handle(): void
    {
    }

    public function model(array $row)
    {
        $listing = Listing::where('name', $row[$this->mappingData['name']])->first();
        if ($listing) {
            foreach ($this->mappingData as $key => $value) {
                $listing->update([
                    $value => $row[$key]
                ]);
            };
        } else {
            $listing = new Listing();
            foreach ($this->mappingData as $key => $value) {
                $listing->$value = $row[$key];
            };
            $listing->save();
        }
        return $listing;
    }

    public function chunkSize(): int
    {
        return 100; // Change chunk size according to your needs.
    }
}
