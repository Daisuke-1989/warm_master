
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateUsersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("users", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->integer('type');
						$table->string('firstname');
						$table->string('lastname');
						$table->string('email');
						$table->timestamp('email_verified_at')->nullable();
						$table->string('password');
						$table->integer('life');
						$table->string('remember_token',100);
						$table->timestamps();
						$table->unique('email');





						// ----------------------------------------------------
						// -- SELECT [users]--
						// ----------------------------------------------------
						// $query = DB::table("users")
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
                Schema::dropIfExists("users");
            }
        }
