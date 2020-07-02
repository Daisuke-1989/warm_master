
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateInstsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("insts", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('inst_name');
						$table->bigInteger('nations_id')->unsigned();
						$table->integer('life');
						$table->timestamps();
						$table->unique('inst_name');


						$table->foreign("nations_id")->references("id")->on("nations");



						// ----------------------------------------------------
						// -- SELECT [insts]--
						// ----------------------------------------------------
						// $query = DB::table("insts")
						// ->leftJoin("nations","nations.id", "=", "insts.nations_id")
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
                Schema::dropIfExists("insts");
            }
        }
