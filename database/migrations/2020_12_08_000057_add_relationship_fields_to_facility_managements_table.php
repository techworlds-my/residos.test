<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFacilityManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('facility_managements', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_fk_2744983')->references('id')->on('facility_categories');
        });
    }
}
