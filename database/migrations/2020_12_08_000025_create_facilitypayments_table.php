<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitypaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('facilitypayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
