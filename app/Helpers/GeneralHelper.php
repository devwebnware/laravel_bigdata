<?php
namespace App\Helpers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;

class GeneralHelper
{
    public static function getDropdowns()
    {
        $listings = Listing::all();
        $cities = $listings->pluck('city')->filter()->unique();
        $states = $listings->pluck('state')->filter()->unique();
        $countries = $listings->pluck('country')->filter()->unique();
        
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();
        $users = User::select('id', 'name')->get();
        
        return [
            'cities' => $cities,
            'states' => $states,
            'countries' => $countries,
            'categories' => $categories,
            'tags'=> $tags,
            'users' => $users,
        ];
    }
}