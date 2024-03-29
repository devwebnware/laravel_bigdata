<?php

namespace App\Jobs;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class ImportDataJob implements ToModel, WithChunkReading, ShouldQueue
{
    public function handle(): void
    {
    }

    public function model(array $row)
    {
        $listing = new Listing([
            'name' => $row[0],
            'query' => $row[1],
            'site' => $row[2],
            'type' => $row[3],
            'subtypes' => $row[4],
            'phone' => $row[5],
            'full_address' => $row[6],
            'borough' => $row[7],
            'street' => $row[8],
            'city' => $row[9],
            'postal_code' => $row[10],
            'state' => $row[11],
            'us_state' => $row[12],
            'country' => $row[13],
            'country_code' => $row[14],
            'latitude' => $row[15],
            'longitude' => $row[16],
            'time_zone' => $row[17],
            'plus_code' => $row[18],
            'area_service' => $row[19],
            'rating' => $row[20],
            'reviews' => $row[21],
            'reviews_link' => $row[22],
            'reviews_per_score' => $row[23],
            'reviews_per_score_1' => $row[24],
            'reviews_per_score_2' => $row[25],
            'reviews_per_score_3' => $row[26],
            'reviews_per_score_4' => $row[27],
            'reviews_per_score_5' => $row[28],
            'photos_count' => $row[29],
            'photo' => $row[30],
            'street_view' => $row[31],
            'located_in' => $row[32],
            'working_hours' => $row[33],
            'working_hours_old_format' => $row[34],
            'other_hours' => $row[35],
            'popular_times' => $row[36],
            'business_status' => $row[37],
            'about' => $row[38],
            'range' => $row[39],
            'posts' => $row[40],
            'logo' => $row[41],
            'description' => $row[42],
            'verified' => $row[43],
            'owner_id' => $row[44],
            'owner_title' => $row[45],
            'owner_link' => $row[46],
            'reservation_links' => $row[47],
            'booking_appointment_link' => $row[48],
            'menu_link' => $row[49],
            'order_links' => $row[50],
            'location_link' => $row[51],
            'place_id' => $row[52],
            'google_id' => $row[53],
            'cid' => $row[54],
            'reviews_id' => $row[55],
            'located_google_id' => $row[56],
            'email_1' => $row[57],
            'email_1_full_name' => $row[58],
            'email_1_title' => $row[59],
            'email_2' => $row[60],
            'email_2_full_name' => $row[61],
            'email_2_title' => $row[62],
            'email_3' => $row[63],
            'email_3_full_name' => $row[64],
            'email_3_title' => $row[65],
            'phone_1' => $row[66],
            'phone_2' => $row[67],
            'phone_3' => $row[68],
            'facebook' => $row[69],
            'instagram' => $row[70],
            'linkedin' => $row[71],
            'medium' => $row[72],
            'reddit' => $row[73],
            'skype' => $row[74],
            'snapchat' => $row[75],
            'telegram' => $row[76],
            'whatsapp' => $row[77],
            'twitter' => $row[78],
            'vimeo' => $row[79],
            'youtube' => $row[80],
            'github' => $row[81],
            'crunchbase' => $row[82],
            'website_title' => $row[83],
            'website_generator' => $row[84],
            'website_description' => $row[85],
            'website_keywords' => $row[86],
            'website_has_fb_pixel' => $row[87],
            'website_has_google_tag' => $row[88],
        ]);
        $listing->save();
        return $listing;
    }

    public function chunkSize(): int
    {
        // Specify the number of rows to process per chunk
        // Adjust this value based on your application's requirements
        return 100;
    }
}
