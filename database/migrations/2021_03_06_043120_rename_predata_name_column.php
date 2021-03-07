<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePredataNameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('predatas', function (Blueprint $table) {
            $table->renameColumn('name', 'predata_cat_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('predatas', function (Blueprint $table) { 
                $table->renameColumn('predata_cat_name', 'name');
        });
    }
}
