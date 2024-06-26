<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class FieldsSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            'query',
            'site',
            'type',
            'subtypes',
            'phone',
            'full_address',
            'borough',
            'street',
            'city',
            'postal_code',
            'state',
            'us_state',
            'country',
            'country_code',
            'latitude',
            'longitude',
            'time_zone',
            'plus_code',
            'area_service',
            'rating',
            'reviews',
            'reviews_link',
            'reviews_per_score',
            'reviews_per_score_1',
            'reviews_per_score_2',
            'reviews_per_score_3',
            'reviews_per_score_4',
            'reviews_per_score_5',
            'photos_count',
            'photo',
            'street_view',
            'located_in',
            'working_hours',
            'working_hours_old_format',
            'other_hours',
            'popular_times',
            'business_status',
            'about',
            'range',
            'posts',
            'logo',
            'description',
            'verified',
            'owner_id',
            'owner_title',
            'owner_link',
            'reservation_links',
            'booking_appointment_link',
            'menu_link',
            'order_links',
            'location_link',
            'place_id',
            'google_id',
            'cid',
            'reviews_id',
            'located_google_id',
            'email_1',
            'email_1_full_name',
            'email_1_title',
            'email_2',
            'email_2_full_name',
            'email_2_title',
            'email_3',
            'email_3_full_name',
            'email_3_title',
            'phone_1',
            'phone_2',
            'phone_3',
            'facebook',
            'instagram',
            'linkedin',
            'medium',
            'reddit',
            'skype',
            'snapchat',
            'telegram',
            'whatsapp',
            'twitter',
            'vimeo',
            'youtube',
            'github',
            'crunchbase',
            'website_title',
            'website_generator',
            'website_description',
            'website_keywords',
            'website_has_fb_pixel',
            'website_has_google_tag'
        ];

        foreach ($fields as $fieldName) {
            $field = new Field;
            $field->name = $fieldName;
            $field->type = 'text';
            $field->created_by = 1;

            if ($field->save()) {
                Schema::table('listings', function (Blueprint $table) use ($fieldName) {
                    $columnName = $fieldName;
                    $columnType = 'text';
                    $table->$columnType($columnName)->nullable();
                });
            }
        }
    }
}
