<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSNMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_n_maps', function (Blueprint $table) {
            $table->unsignedInteger('students_id');
            $table->unsignedInteger('nations_id');
            $table->timestamps();

            $table->index('students_id');
            $table->index('nations_id');

            $table->unique([
                'students_id',
                'nations_id'
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
        Schema::dropIfExists('s_n_maps');
    }
}
