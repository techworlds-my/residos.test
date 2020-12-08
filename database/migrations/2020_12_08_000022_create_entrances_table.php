<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrancesTable extends Migration
{
    public function up()
    {
        Schema::create('entrances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_active')->nullable();
            $table->boolean('in_enable')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
