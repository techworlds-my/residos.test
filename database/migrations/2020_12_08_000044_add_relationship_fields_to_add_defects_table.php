<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddDefectsTable extends Migration
{
    public function up()
    {
        Schema::table('add_defects', function (Blueprint $table) {
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2745229')->references('id')->on('users');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_fk_2745230')->references('id')->on('defact_categories');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_2745231')->references('id')->on('status_controls');
            $table->unsignedBigInteger('inchargeperson_id')->nullable();
            $table->foreign('inchargeperson_id', 'inchargeperson_fk_2745232')->references('id')->on('users');
        });
    }
}
