<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarparkLogsTable extends Migration
{
    public function up()
    {
        Schema::table('carpark_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('carplate_id');
            $table->foreign('carplate_id', 'carplate_fk_2744510')->references('id')->on('vehicle_managements');
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_2744511')->references('id')->on('carpark_locations');
        });
    }
}
