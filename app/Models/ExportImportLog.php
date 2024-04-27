<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportImportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', // 1 = export, 0 = import
        'user_id',
    ];

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
