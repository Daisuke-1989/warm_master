
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateNationsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("nations", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->integer('rgn_id');
						$table->string('region');
						$table->string('country');
						$table->timestamps();






						// ----------------------------------------------------
						// -- SELECT [nations]--
						// ----------------------------------------------------
						// $query = DB::table("nations")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("nations");
            }
        }
