<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('facility_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('desctiption');
            $table->string('status');
            $table->string('name');
            $table->time('open');
            $table->time('closed');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
