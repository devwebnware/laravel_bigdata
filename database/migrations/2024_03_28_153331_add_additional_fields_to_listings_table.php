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
        });
    }

    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn([
                'query', 'site', 'type', 'subtypes', 'phone', 'full_address', 'borough', 'street', 'city', 'postal_code', 'state', 'us_state', 'country', 'country_code', 'latitude', 'longitude', 'time_zone', 'plus_code', 'area_service', 'rating', 'reviews', 'reviews_link', 'reviews_per_score', 'reviews_per_score_1'
            ]);
        });
    }
};
