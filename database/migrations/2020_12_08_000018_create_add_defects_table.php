<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddDefectsTable extends Migration
{
    public function up()
    {
        Schema::create('add_defects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('defect');
            $table->date('available_date');
            $table->time('available_time');
            $table->string('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
