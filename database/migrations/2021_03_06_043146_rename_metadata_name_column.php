<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMetadataNameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metadatas', function (Blueprint $table) {
            $table->renameColumn('name', 'metadata_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metadatas', function (Blueprint $table) {
            $table->renameColumn('metadata_name', 'name');
        });
    }
}
