<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('histories', function (Blueprint $table) {
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2745118')->references('id')->on('users');
            $table->unsignedBigInteger('entrance_id');
            $table->foreign('entrance_id', 'entrance_fk_2746292')->references('id')->on('entrances');
        });
    }
}
