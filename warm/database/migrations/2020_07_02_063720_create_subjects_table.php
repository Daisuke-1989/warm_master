
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateSubjectsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("subjects", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('subject');
						$table->timestamps();






						// ----------------------------------------------------
						// -- SELECT [subjects]--
						// ----------------------------------------------------
						// $query = DB::table("subjects")
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
                Schema::dropIfExists("subjects");
            }
        }
