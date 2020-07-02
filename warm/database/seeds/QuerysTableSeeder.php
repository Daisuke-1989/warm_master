<?php
use Illuminate\Database\Seeder;

    class QuerysTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //Cmd: php artisan db:seed --class="QuerysTableSeeder"
            
            $faker = Faker\Factory::create("ja_JP");
            
            for( $i=0; $i<10; $i++ ){

                App\Query::create([
					"events_id" => $faker->randomDigit(),
					"terms_id" => $faker->randomDigit(),
					"students_id" => $faker->randomDigit(),
					"dtls" => $faker->word(),
					"created_at" => $faker->dateTime("now"),
					"updated_at" => $faker->dateTime("now")
                ]);
            }
        }
    }