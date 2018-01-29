<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomepageCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('link_title');
            $table->string('link');
            $table->enum('active',['yes','no'])->default('yes');
            $table->string('image');
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
        Schema::drop('homepage_categories');
    }
}
