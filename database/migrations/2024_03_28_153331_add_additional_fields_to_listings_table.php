<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToListingsTable extends Migration
{
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->text('query', 255)->nullable();
            $table->text('site')->nullable();
            $table->text('type')->nullable();
            $table->text('subtypes')->nullable();
            $table->text('phone')->nullable();
            $table->text('full_address', 255)->nullable();
            $table->text('borough')->nullable();
            $table->text('street')->nullable();
            $table->text('city')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('state')->nullable();
            $table->text('us_state')->nullable();
            $table->text('country')->nullable();
            $table->text('country_code')->nullable();
            $table->text('latitude')->nullable();
            $table->text('longitude')->nullable();
            $table->text('time_zone')->nullable();
            $table->text('plus_code')->nullable();
            $table->text('area_service')->nullable();
            $table->text('rating')->nullable();
            $table->text('reviews')->nullable();
            $table->text('reviews_link')->nullable();
            $table->text('reviews_per_score')->nullable();
            $table->text('reviews_per_score_1')->nullable();
            $table->text('reviews_per_score_2')->nullable();
            $table->text('reviews_per_score_3')->nullable();
            $table->text('reviews_per_score_4')->nullable();
            $table->text('reviews_per_score_5')->nullable();
            $table->text('photos_count')->nullable();
            $table->text('photo')->nullable();
            $table->text('street_view')->nullable();
            $table->text('located_in')->nullable();
            $table->text('working_hours')->nullable();
            $table->text('working_hours_old_format')->nullable();
            $table->text('other_hours')->nullable();
            $table->text('popular_times')->nullable();
            $table->text('business_status')->nullable();
            $table->text('about')->nullable();
            $table->text('range')->nullable();
            $table->text('posts')->nullable();
            $table->text('logo')->nullable();
            $table->text('description')->nullable();
            $table->text('verified')->nullable();
            $table->text('owner_id')->nullable();
            $table->text('owner_title')->nullable();
            $table->text('owner_link', 255)->nullable();
            $table->text('reservation_links', 255)->nullable();
            $table->text('booking_appointment_link', 255)->nullable();
            $table->text('menu_link', 255)->nullable();
            $table->text('order_links', 255)->nullable();
            $table->text('location_link', 255)->nullable();
            $table->text('place_id')->nullable();
            $table->text('google_id')->nullable();
            $table->text('cid')->nullable();
            $table->text('reviews_id')->nullable();
            $table->text('located_google_id')->nullable();
            $table->text('email_1')->nullable();
            $table->text('email_1_full_name')->nullable();
            $table->text('email_1_title')->nullable();
            $table->text('email_2')->nullable();
            $table->text('email_2_full_name')->nullable();
            $table->text('email_2_title')->nullable();
            $table->text('email_3')->nullable();
            $table->text('email_3_full_name')->nullable();
            $table->text('email_3_title')->nullable();
            $table->text('phone_1')->nullable();
            $table->text('phone_2')->nullable();
            $table->text('phone_3')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkedin')->nullable();
            $table->text('medium')->nullable();
            $table->text('reddit')->nullable();
            $table->text('skype')->nullable();
            $table->text('snapchat')->nullable();
            $table->text('telegram')->nullable();
            $table->text('whatsapp')->nullable();
            $table->text('twitter')->nullable();
            $table->text('vimeo')->nullable();
            $table->text('youtube')->nullable();
            $table->text('github')->nullable();
            $table->text('crunchbase')->nullable();
            $table->text('website_title')->nullable();
            $table->text('website_generator')->nullable();
            $table->text('website_description')->nullable();
            $table->text('website_keywords')->nullable();
            $table->text('website_has_fb_pixel')->nullable();
            $table->text('website_has_google_tag')->nullable();
        });
    }

    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn([
                'query', 'site', 'type', 'subtypes', 'phone', 'full_address', 'borough', 'street', 'city', 'postal_code', 'state', 'us_state', 'country', 'country_code', 'latitude', 'longitude', 'time_zone', 'plus_code', 'area_service', 'rating', 'reviews', 'reviews_link', 'reviews_per_score', 'reviews_per_score_1', 'reviews_per_score_2', 'reviews_per_score_3', 'reviews_per_score_4', 'reviews_per_score_5', 'photos_count', 'photo', 'street_view', 'located_in', 'working_hours', 'working_hours_old_format', 'other_hours', 'popular_times', 'business_status', 'about', 'range', 'posts', 'logo', 'description', 'verified', 'owner_id', 'owner_title', 'owner_link', 'reservation_links', 'booking_appointment_link', 'menu_link', 'order_links', 'location_link', 'place_id', 'google_id', 'cid', 'reviews_id', 'located_google_id', 'email_1', 'email_1_full_name', 'email_1_title', 'email_2', 'email_2_full_name', 'email_2_title', 'email_3', 'email_3_full_name', 'email_3_title', 'phone_1', 'phone_2', 'phone_3', 'facebook', 'instagram', 'linkedin', 'medium', 'reddit', 'skype', 'snapchat', 'telegram', 'whatsapp', 'twitter', 'vimeo', 'youtube', 'github', 'crunchbase', 'website_title', 'website_generator', 'website_description', 'website_keywords', 'website_has_fb_pixel', 'website_has_google_tag'
            ]);
        });
    }
};
