<?php

namespace App\Jobs;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ImportDataJob implements ToModel, WithChunkReading, ShouldQueue
{
    protected $mappingData;

    public function __construct($mappingData)
    {
        dd($mappingData);
    }

    public function handle(): void
    {
    }

    public function model(array $row)
    {
        dd($this->mappingData, $row);
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
        // Specify the number of rows to process per chunk
        // Adjust this value based on your application's requirements
        return 100;
    }
}
