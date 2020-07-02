
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateBooksTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("books", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('events_id')->unsigned();
						$table->bigInteger('students_id')->unsigned();
						$table->integer('CXL');
						$table->timestamps();



						$table->foreign("events_id")->references("id")->on("events");
						$table->foreign("students_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [books]--
						// ----------------------------------------------------
						// $query = DB::table("books")
						// ->leftJoin("events","events.id", "=", "books.events_id")
						// ->leftJoin("users","users.id", "=", "books.students_id")
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
                Schema::dropIfExists("books");
            }
        }
