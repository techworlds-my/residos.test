<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('maintenances_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->string('month');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
