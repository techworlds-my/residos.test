<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarparkLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('carpark_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location');
            $table->boolean('is_enable')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
