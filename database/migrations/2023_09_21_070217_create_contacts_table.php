<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('contact_country_name')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('contact_tel_label')->nullable();
            $table->string('contact_tel_number')->nullable();
            $table->string('contact_email_label')->nullable();
            $table->string('contact_email_address')->nullable();
            $table->string('contact_email_url')->nullable();
            $table->string('contact_site_name')->nullable();
            $table->string('contact_site_url')->nullable();
            $table->boolean('contact_status')->default(true);
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
        Schema::dropIfExists('contacts');
    }
}
