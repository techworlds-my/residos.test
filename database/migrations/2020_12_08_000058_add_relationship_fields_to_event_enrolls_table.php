<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventEnrollsTable extends Migration
{
    public function up()
    {
        Schema::table('event_enrolls', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_fk_2744637')->references('id')->on('event_controls');
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2744638')->references('id')->on('users');
        });
    }
}
