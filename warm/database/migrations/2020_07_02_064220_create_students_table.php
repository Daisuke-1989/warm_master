
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateStudentsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("students", function (Blueprint $table) {

						$table->bigInteger('id')->unsigned();
						$table->bigInteger('nations_id')->unsigned();
						$table->string('year');
						$table->timestamps();



						$table->foreign("id")->references("id")->on("users");
						$table->foreign("nations_id")->references("id")->on("nations");



						// ----------------------------------------------------
						// -- SELECT [students]--
						// ----------------------------------------------------
						// $query = DB::table("students")
						// ->leftJoin("users","users.id", "=", "students.id")
						// ->leftJoin("nations","nations.id", "=", "students.nations_id")
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
                Schema::dropIfExists("students");
            }
        }
