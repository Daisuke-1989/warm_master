
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateTermsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("terms", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('term');
						$table->timestamps();



						// ----------------------------------------------------
						// -- SELECT [terms]--
						// ----------------------------------------------------
						// $query = DB::table("terms")
						// ->leftJoin("querys","querys.terms_id", "=", "terms.id")
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
                Schema::dropIfExists("terms");
            }
        }
