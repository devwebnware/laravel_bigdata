<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingTag extends Model
{
    use HasFactory;
    protected $table = 'listing_tags';

    public function tagName()
    {
       return $this->belongsTo(Tag::class,'tag_id','id');
    }
    public function listing()
    {
       return $this->belongsTo(Listing::class,'listing_id','id');
    }
}
