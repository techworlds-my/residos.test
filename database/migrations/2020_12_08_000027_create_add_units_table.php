<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('add_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit');
            $table->string('floor');
            $table->float('unit_square', 15, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
