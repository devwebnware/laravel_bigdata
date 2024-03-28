<?php

namespace App\Jobs;

use App\Models\Listing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class ImportDataJob implements ToModel, WithChunkReading, ShouldQueue
{
    public function handle(): void
    {
    }

    public function model(array $row)
    {
        $listing = new Listing([
            'name' => $row[0],
            'category_id' => $row[1],
            'tag_id' => $row[2],
            'created_by' => $row[3],
            'query' => $row[4],
            'site' => $row[5],
            'type' => $row[6],
            'subtypes' => $row[7],
            'phone' => $row[8],
            'full_address' => $row[9],
            'borough' => $row[10],
            'street' => $row[11],
            'city' => $row[12],
            'postal_code' => $row[13],
            'state' => $row[14],
            'us_state' => $row[15],
            'country' => $row[16],
            'country_code' => $row[17],
            'latitude' => $row[18],
            'longitude' => $row[19],
            'time_zone' => $row[20],
            'plus_code' => $row[21],
            'area_service' => $row[22],
            'rating' => $row[23],
            'reviews' => $row[24],
            'reviews_link' => $row[25],
            'reviews_per_score' => $row[26],
            'reviews_per_score_1' => $row[27],
            'reviews_per_score_2' => $row[28],
            'reviews_per_score_3' => $row[29],
            'reviews_per_score_4' => $row[30],
            'reviews_per_score_5' => $row[31],
            'photos_count' => $row[32],
            'photo' => $row[33],
            'street_view' => $row[34],
            'located_in' => $row[35],
            'working_hours' => $row[36],
            'working_hours_old_format' => $row[37],
            'other_hours' => $row[38],
            'popular_times' => $row[39],
            'business_status' => $row[40],
            'about' => $row[41],
            'range' => $row[42],
            'posts' => $row[43],
            'logo' => $row[44],
            'description' => $row[45],
            'verified' => $row[46],
            'owner_id' => $row[47],
            'owner_title' => $row[48],
            'owner_link' => $row[49],
            'reservation_links' => $row[50],
            'booking_appointment_link' => $row[51],
            'menu_link' => $row[52],
            'order_links' => $row[53],
            'location_link' => $row[54],
            'place_id' => $row[55],
            'google_id' => $row[56],
            'cid' => $row[57],
            'reviews_id' => $row[58],
            'located_google_id' => $row[59],
            'email_1' => $row[60],
            'email_1_full_name' => $row[61],
            'email_1_title' => $row[62],
            'email_2' => $row[63],
            'email_2_full_name' => $row[64],
            'email_2_title' => $row[65],
            'email_3' => $row[66],
            'email_3_full_name' => $row[67],
            'email_3_title' => $row[68],
            'phone_1' => $row[69],
            'phone_2' => $row[70],
            'phone_3' => $row[71],
            'facebook' => $row[72],
            'instagram' => $row[73],
            'linkedin' => $row[74],
            'medium' => $row[75],
            'reddit' => $row[76],
            'skype' => $row[77],
            'snapchat' => $row[78],
            'telegram' => $row[79],
            'whatsapp' => $row[80],
            'twitter' => $row[81],
            'vimeo' => $row[82],
            'youtube' => $row[83],
            'github' => $row[84],
            'crunchbase' => $row[85],
            'website_title' => $row[86],
            'website_generator' => $row[87],
            'website_description' => $row[88],
            'website_keywords' => $row[89],
            'website_has_fb_pixel' => $row[90],
            'website_has_google_tag' => $row[91],
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
