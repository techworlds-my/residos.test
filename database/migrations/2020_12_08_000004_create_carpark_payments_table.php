<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarparkPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('carpark_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('carplate');
            $table->integer('payment');
            $table->string('payment_method')->nullable();
            $table->string('remark')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
