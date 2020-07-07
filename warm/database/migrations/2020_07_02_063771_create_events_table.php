
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateEventsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("events", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('title');
						$table->bigInteger('insts_id')->unsigned();
						$table->date('date');
						$table->string('start_time');
						$table->string('end_time');
						$table->string('dtls');
						$table->string('img');
						$table->integer('capacity');
						$table->bigInteger('inst_users_id')->unsigned();
						$table->timestamps();



						$table->foreign("insts_id")->references("id")->on("insts");
						$table->foreign("inst_users_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [events]--
						// ----------------------------------------------------
						// $query = DB::table("events")
						// ->leftJoin("insts","insts.id", "=", "events.insts_id")
						// ->leftJoin("users","users.id", "=", "events.inst_users_id")
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
                Schema::dropIfExists("events");
            }
        }
