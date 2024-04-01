<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class ListingsImport implements ToCollection
{
    protected $validRows = [];

    public function collection(Collection $rows)
    {
        $errors = [];
        $lineNumber = 0;

        foreach ($rows as $row) {
            $lineNumber++;

            $validator = Validator::make([
                'column1' => $row[0],
                'column2' => $row[1],
            ], [
                'column1' => 'required',
                'column2' => 'required',
            ]);

            if ($validator->fails()) {
                $errors[] = "Line $lineNumber: " . implode(', ', $validator->errors()->all());
            } else {
                // Store the valid row
                $this->validRows[] = [
                    'column1' => $row[0],
                    'column2' => $row[1],
                ];
            }
        }

        if (!empty($errors)) {
            // Throw an exception with errors
            throw new \Exception(implode(PHP_EOL, $errors));
        }
    }

    public function getValidRows()
    {
        return $this->validRows;
    }
}
