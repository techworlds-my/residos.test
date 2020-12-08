<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckFacilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('check_facilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->longText('description')->nullable();
            $table->datetime('date_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
