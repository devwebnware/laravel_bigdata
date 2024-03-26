<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;
    protected $table = 'dropdowns';
    protected $fillable = ['key','key_sub', 'value','status'];
}