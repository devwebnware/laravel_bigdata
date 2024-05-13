<?php

namespace App\Helpers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Listing;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

class GeneralHelper
{
    public static function getDropdowns()
    {
        $listings = Listing::all();
        $cities = $listings->pluck('city')->filter()->unique()->limit(10);
        $states = $listings->pluck('state')->filter()->unique()->limit(10);
        // $countries = $listings->pluck('country')->filter()->unique();

        $categories = Category::select('id', 'name')->limit(10)->get();
        $tags = Tag::select('id', 'name')->limit(10)->get();
        // $users = User::select('id', 'name')->get();

        return [
            'cities' => $cities,
            'states' => $states,
            // 'countries' => $countries,
            'categories' => $categories,
            'tags' => $tags,
            // 'users' => $users,
        ];
    }
}
