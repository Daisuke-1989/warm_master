<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateELMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_l_maps', function (Blueprint $table) {
            $table->unsignedInteger('events_id');
            $table->unsignedInteger('levels_id');
            $table->timestamps();

            $table->index('events_id');
            $table->index('levels_id');

            $table->unique([
                'events_id',
                'levels_id'
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
        Schema::dropIfExists('e_l_maps');
    }
}
