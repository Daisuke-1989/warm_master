<?php
use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //Cmd: php artisan db:seed --class="UsersTableSeeder"
            
            $faker = Faker\Factory::create("ja_JP");
            
            for( $i=0; $i<10; $i++ ){

                App\User::create([
					"type" => $faker->randomDigit(),
					"firstname" => $faker->name(),
					"lastname" => $faker->name(),
					"email" => $faker->safeEmail(),
					"email_verified_at" => $faker->dateTime(),
					"password" => $faker->password(),
					"life" => $faker->randomDigit(),
					"remember_token" => $faker->sha1(),
					"created_at" => $faker->dateTime("now"),
					"updated_at" => $faker->dateTime("now")
                ]);
            }
        }
    }