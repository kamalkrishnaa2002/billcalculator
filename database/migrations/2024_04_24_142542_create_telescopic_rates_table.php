<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateTelescopicRatesTable extends Migration
{
    public function up()
    {
        Schema::create('telescopic_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('start_units');
            $table->integer('end_units')->nullable();
            $table->decimal('rate', 8, 2);
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('telescopic_rates');
    }
}

