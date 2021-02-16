<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadatas', function (Blueprint $table) {
            $table->id('metadata_id');
            $table->unsignedBigInteger('predata');
            $table->string('name')->unique();
            $table->integer('number');
            $table->string('meta_model');
            $table->string('model_weight');
            $table->string('model');
            $table->string('active');
            $table->timestamps();
            $table->foreign('predata')->references('predata_id')->on('predatas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('metadata');
    }
}
