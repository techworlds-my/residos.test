<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddVisitorsTable extends Migration
{
    public function up()
    {
        Schema::table('add_visitors', function (Blueprint $table) {
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2745028')->references('id')->on('users');
            $table->unsignedBigInteger('add_by_id')->nullable();
            $table->foreign('add_by_id', 'add_by_fk_2745029')->references('id')->on('users');
        });
    }
}
