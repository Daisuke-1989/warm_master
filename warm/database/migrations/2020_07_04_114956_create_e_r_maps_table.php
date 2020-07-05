<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateERMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_r_maps', function (Blueprint $table) {
            $table->unsignedInteger('events_id');
            $table->unsignedInteger('regions_id');
            $table->timestamps();

            $table->index('events_id');
            $table->index('regions_id');

            $table->unique([
                'events_id',
                'regions_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('e_r_maps');
    }
}
