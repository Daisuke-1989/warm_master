<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateESbjMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_sbj_maps', function (Blueprint $table) {
            $table->unsignedInteger('events_id');
            $table->unsignedInteger('subjects_id');
            $table->timestamps();

            $table->index('events_id');
            $table->index('subjects_id');

            $table->unique([
                'events_id',
                'subjects_id'
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
        Schema::dropIfExists('e_sbj_maps');
    }
}
