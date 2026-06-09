<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('whatsapp_image')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('phone')->nullable();  
            $table->string('email_label')->nullable();
            $table->string('email_address')->nullable();
            $table->string('email_link')->nullable();
            $table->string('skype_icon')->nullable();
            $table->string('skype_label')->nullable();
            $table->string('skype_url')->nullable();
            $table->string('contact_our_project')->nullable();
            $table->longText('contact_notes_area')->nullable();
            $table->string('contact_us_heading')->nullable();
            $table->string('site_titel')->nullable();
            $table->string('copy_right')->nullable();
            //new feild
            $table->string('whatsapp_url')->nullable();
            $table->string('phone_number_one')->nullable();
            $table->string('country_name_one_label')->nullable();
            $table->string('phone_number_two')->nullable();
            $table->string('country_name_two_label')->nullable();
            $table->string('phone_number_three')->nullable();
            $table->string('country_name_three_label')->nullable();
            $table->string('teams_url')->nullable();

            $table->string('type', 50)->default('setting');
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
        Schema::dropIfExists('settings');
    }
}
