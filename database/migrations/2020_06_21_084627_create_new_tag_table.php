<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('new_id')->unsigned()->nullable();;
            $table->integer('tag_id')->unsigned()->nullable();;
            $table->timestamps();

            $table->foreign('new_id')->references('id')->on('news')->onDelete('set null')
            ->onUpdate('cascade');;
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null')
            ->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_tag');
    }
}
