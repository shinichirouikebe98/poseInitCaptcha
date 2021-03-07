<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIconsNameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poseicons', function (Blueprint $table) {
            $table->renameColumn('name', 'icons_name');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poseicons', function (Blueprint $table) {
            $table->renameColumn('icons_name', 'name');
        });


    }
}
