<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarparkPaymentsTable extends Migration
{
    public function up()
    {
        Schema::table('carpark_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id', 'location_fk_2744744')->references('id')->on('carpark_locations');
        });
    }
}
