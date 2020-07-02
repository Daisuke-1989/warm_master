<?php
use Illuminate\Database\Seeder;

    class InstUsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //Cmd: php artisan db:seed --class="InstUsersTableSeeder"
            
            $faker = Faker\Factory::create("ja_JP");
            
            for( $i=0; $i<10; $i++ ){

                App\InstUser::create([
					"id" => $faker->randomDigit(),
					"inst_id" => $faker->randomDigit(),
					"j_title" => $faker->word(),
					"dept" => $faker->word(),
					"created_at" => $faker->dateTime("now"),
					"updated_at" => $faker->dateTime("now")
                ]);
            }
        }
    }