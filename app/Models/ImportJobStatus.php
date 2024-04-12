<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportJobStatus extends Model
{
    use HasFactory;

    protected $table = 'import_job_statuses';
}
