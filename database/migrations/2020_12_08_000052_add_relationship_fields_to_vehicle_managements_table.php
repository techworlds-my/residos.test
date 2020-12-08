<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehicleManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('vehicle_managements', function (Blueprint $table) {
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2744494')->references('id')->on('users');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id', 'brand_fk_2744497')->references('id')->on('vehicle_brands');
            $table->unsignedBigInteger('model_id');
            $table->foreign('model_id', 'model_fk_2751574')->references('id')->on('vehicle_models');
        });
    }
}
