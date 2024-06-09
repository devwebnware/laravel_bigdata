<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listings';
    protected $fillable = [
        'name',
        'category',
    ];

    public function categoryModel()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class, 'parent_category', 'id');
    }

    public function listingTags()
    {
        return $this->belongsToMany(Tag::class, 'listing_tags', 'listing_id', 'tag_id');
    }
}
