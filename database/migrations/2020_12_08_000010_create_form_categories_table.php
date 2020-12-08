<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('form_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category');
            $table->boolean('in_enable')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
