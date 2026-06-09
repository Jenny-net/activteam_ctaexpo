<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('content_title');
            $table->enum('template', ['one', 'two', 'three','portfolio','massportfolio']);
            $table->enum('content_type', ['menu', 'mass', 'home','portfolio','massportfolio'])->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contens');
    }
}
