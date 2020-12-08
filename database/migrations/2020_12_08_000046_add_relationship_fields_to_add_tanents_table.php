<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddTanentsTable extends Migration
{
    public function up()
    {
        Schema::table('add_tanents', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_2746107')->references('id')->on('add_units');
            $table->unsignedBigInteger('tanent_id');
            $table->foreign('tanent_id', 'tanent_fk_2746108')->references('id')->on('users');
        });
    }
}
