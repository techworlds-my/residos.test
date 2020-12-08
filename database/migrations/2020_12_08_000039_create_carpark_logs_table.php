<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarparkLogsTable extends Migration
{
    public function up()
    {
        Schema::create('carpark_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('time_in')->nullable();
            $table->string('time_out')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
