<?php

namespace App\Jobs;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class ImportDataJob implements ToModel, WithChunkReading, ShouldQueue
{
    public function handle(): void
    {
    }

    public function model(array $row)
    {
        $listing = new Listing([
            'id' => $row[0],
            'name' => $row[1],
            'category_id' => $row[2],
            'tag_id' => $row[3],
            'created_by' => $row[4],
        ]);
        $listing->save();
        return $listing;
    }

    public function chunkSize(): int
    {
        // Specify the number of rows to process per chunk
        // Adjust this value based on your application's requirements
        return 100;
    }
}
