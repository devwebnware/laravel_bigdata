<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('employee_id');
            $table->string('fname');
            $table->string('lname');
            $table->string('image')->nullable();
            $table->string('department');
            $table->string('designation');
            $table->date('joining_date');
            $table->string('reporting_manager')->nullable();
            $table->string('email_address');
            $table->integer('pri_country_code');
            $table->string('pri_phone_number');
            $table->integer('sec_country_code')->nullable();
            $table->string('sec_phone_number')->nullable();
            $table->text('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country')->default('India');
            $table->string('zip_code')->nullable();
            $table->string('pan')->nullable();
            $table->date('dob');
            $table->string('gender');
            $table->integer('age');
            $table->string('basic_salary');
            $table->boolean('status')->default(1);
            $table->string('role')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_country_code');
            $table->string('emergency_contact_number');
            $table->string('emergency_contact_relation');
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('upi_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
