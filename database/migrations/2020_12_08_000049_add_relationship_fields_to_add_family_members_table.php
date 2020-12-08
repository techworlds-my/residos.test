<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddFamilyMembersTable extends Migration
{
    public function up()
    {
        Schema::table('add_family_members', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_2746094')->references('id')->on('add_units');
            $table->unsignedBigInteger('family_member_id');
            $table->foreign('family_member_id', 'family_member_fk_2746095')->references('id')->on('users');
        });
    }
}
