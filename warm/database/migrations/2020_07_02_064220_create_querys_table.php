
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateQuerysTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("querys", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('events_id')->unsigned();
						$table->bigInteger('terms_id')->unsigned();
						$table->bigInteger('students_id')->unsigned();
						$table->string('dtls');
						$table->timestamps();



						$table->foreign("events_id")->references("id")->on("events");
                        $table->foreign("students_id")->references("id")->on("users");
                        $table->foreign("terms_id")->references("id")->on("terms");



						// ----------------------------------------------------
						// -- SELECT [querys]--
						// ----------------------------------------------------
						// $query = DB::table("querys")
						// ->leftJoin("events","events.id", "=", "querys.events_id")
						// ->leftJoin("users","users.id", "=", "querys.students_id")
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
                Schema::dropIfExists("querys");
            }
        }
