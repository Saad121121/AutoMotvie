<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sell_my_cars', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('user_id');
            $table->string('city')->nullale();
            $table->string('city_area');
            $table->string('car_info');
            $table->string('color');
            $table->integer('mileage');
            $table->integer('price');
            $table->text('add_description');
            $table->string('upload_image')->nullable();  // Add the 'upload_image' column
            $table->string('model_yaer');
            $table->string('model_company');
            $table->string('company_name');
            $table->string('Registered_user');
            $table->string('publish_ad')->nullable();  // Add the 'upload_image' column
            $table->string('seller_name')->nullable();  // Add the 'upload_image' column
            $table->string('seller_contact')->nullable();  // Add the 'upload_image' column
            $table->string('secondary_contact')->nullable();  // Add the 'upload_image' column
            $table->string('exterior_color')->nullable();  // Add the 'upload_image' column
            
            $table->foreign('user_id')->references('id')->on('users');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_my_cars');
    }
};
