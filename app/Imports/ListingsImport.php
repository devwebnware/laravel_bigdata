<?php

namespace App\Imports;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\ToModel;

class ListingsImport implements ToModel
{
    public function model(array $row)
    {
        return new Listing([
            'id' => $row[0], 
            'name' => $row[1],
            'category_id' => $row[2],
            'tag_id' => $row[3],
            'created_by' => $row[4],
            'created_at' => $row[5],
            'updated_at' => $row[6],
        ]);
    }
}
