<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportDataGroup extends Model
{
    use HasFactory;
    protected $table = 'export_data_group';
    protected $fillable = [
        'group_name',
        'column_names'
    ];
}
