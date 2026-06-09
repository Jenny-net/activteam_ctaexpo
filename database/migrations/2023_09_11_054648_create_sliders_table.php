<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('slider_file');
            $table->enum('type', ['video','image']);
            $table->string('heading');
            $table->string('content');
            $table->string('readmore_label');
            $table->string('page_url');
            $table->string('playbtn_icon');
            $table->string('playbtn_url');
            $table->boolean('status')->default(true); 
            $table->integer('order_by')->nullable();
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
        Schema::dropIfExists('sliders');
    }
}
