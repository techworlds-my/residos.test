<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddFeedbacksTable extends Migration
{
    public function up()
    {
        Schema::table('add_feedbacks', function (Blueprint $table) {
            $table->unsignedBigInteger('username_id');
            $table->foreign('username_id', 'username_fk_2744688')->references('id')->on('users');
        });
    }
}
