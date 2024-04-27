<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ListingsImport implements ToCollection, WithHeadingRow
{
    protected $validRows = [];
    protected $headers;
    protected $requiredFields;

    public function __construct($headers, $requiredFields = [])
    {
        $this->headers = $headers;
        $this->requiredFields = $requiredFields;
    }

    public function collection(Collection $rows)
    {
        $errors = [];
        $lineNumber = 0;

        foreach ($rows as $row) {
            $lineNumber++;

            foreach ($this->requiredFields as $key => $field) {
                if (!isset($row[$field]) || empty($row[$field])) {
                    $errors[] = "Line $lineNumber: $field is required.";
                    continue 2;
                }
            }

            // Store the valid row
            $this->validRows[] = $row;
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
