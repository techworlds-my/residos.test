<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitManagementsTable extends Migration
{
    public function up()
    {
        Schema::create('unit_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->integer('size');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
