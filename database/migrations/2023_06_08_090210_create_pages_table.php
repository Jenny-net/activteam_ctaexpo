<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['menu', 'mass', 'home','portfolio','massportfolio'])->default('menu');
            $table->unsignedBigInteger('content_id')->nullable();
            $table->string('page_name');
            $table->string('page_url');
            $table->string('meta_title');
            $table->text('meta_Robots');
            $table->string('meta_revisit_after');
            $table->text('meta_description');
            $table->longText('section_one');
            $table->longText('section_two');
            $table->longText('section_three');
            $table->longText('section_four');
            $table->longText('section_five');
            $table->longText('section_six');
            $table->longText('section_seven');
            $table->longText('section_eight');
            $table->longText('section_nine');
            $table->longText('section_ten');
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
