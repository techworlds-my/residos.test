<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('event_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2744949')->references('id')->on('users');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_fk_2744950')->references('id')->on('event_controls');
        });
    }
}
