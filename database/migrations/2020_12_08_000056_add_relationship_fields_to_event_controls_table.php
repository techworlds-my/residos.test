<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventControlsTable extends Migration
{
    public function up()
    {
        Schema::table('event_controls', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_fk_2744630')->references('id')->on('event_categories');
            $table->unsignedBigInteger('audience_group_id')->nullable();
            $table->foreign('audience_group_id', 'audience_group_fk_2744631')->references('id')->on('roles');
        });
    }
}
