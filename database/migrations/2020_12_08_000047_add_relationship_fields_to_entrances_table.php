<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEntrancesTable extends Migration
{
    public function up()
    {
        Schema::table('entrances', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id', 'location_fk_2746287')->references('id')->on('locations');
        });
    }
}
