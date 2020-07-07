<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSLMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_l_maps', function (Blueprint $table) {
            $table->unsignedInteger('students_id');
            $table->unsignedInteger('levels_id');
            $table->timestamps();

            $table->index('students_id');
            $table->index('levels_id');

            $table->unique([
                'students_id',
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
        Schema::dropIfExists('s_l_maps');
    }
}
