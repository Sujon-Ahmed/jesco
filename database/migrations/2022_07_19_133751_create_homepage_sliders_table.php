<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('sub_title');
            $table->string('title');
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=unpublish, 1=publish');
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
        Schema::dropIfExists('homepage_sliders');
    }
}
