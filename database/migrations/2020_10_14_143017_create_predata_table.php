<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePredataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predatas', function (Blueprint $table) {
            $table->id('predata_id');
            $table->string('name')->unique();
            $table->string('predata_name');
            $table->integer('number');
            $table->string('pose_one');
            $table->string('pose_two');
            $table->string('pose_three');
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
        Schema::dropIfExists('predata');
    }
}
