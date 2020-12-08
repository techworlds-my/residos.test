<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCheckFacilitiesTable extends Migration
{
    public function up()
    {
        Schema::table('check_facilities', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_2745858')->references('id')->on('users');
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id', 'facility_fk_2745909')->references('id')->on('facility_managements');
            $table->unsignedBigInteger('defect_id')->nullable();
            $table->foreign('defect_id', 'defect_fk_2745910')->references('id')->on('defact_categories');
        });
    }
}
