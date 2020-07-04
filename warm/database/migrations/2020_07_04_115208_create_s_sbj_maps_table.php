<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSSbjMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_sbj_maps', function (Blueprint $table) {
            $table->unsignedInteger('students_id');
            $table->unsignedInteger('subjects_id');
            $table->timestamps();

            $table->index('students_id');
            $table->index('subjects_id');

            $table->unique([
                'students_id',
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
        Schema::dropIfExists('s_sbj_maps');
    }
}
