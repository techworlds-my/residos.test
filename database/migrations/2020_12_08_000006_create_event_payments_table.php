<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('event_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('payment');
            $table->string('payment_method')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
