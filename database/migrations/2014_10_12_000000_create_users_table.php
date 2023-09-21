<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_namw');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('otp')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('user_type')->nullable();
            $table->date('dob')->nullable();
            $table->string('full_address')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->bigInteger('patient_id')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('relationship_to_patient')->nullable();
            $table->string('gender')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('major_disease')->nullable();
            $table->string('medical_condition')->nullable();
            $table->string('relationship_status')->nullable();
            $table->string('fcm_token', 500)->nullable();
            $table->string('social_type')->nullable();
            $table->string('social_id', 1000)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
