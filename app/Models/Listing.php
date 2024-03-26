<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'tag_id',
        'created_by', // Ensure created_by is included in fillable
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
