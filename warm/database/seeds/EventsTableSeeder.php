<?php
use Illuminate\Database\Seeder;

    class EventsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            //Cmd: php artisan db:seed --class="EventsTableSeeder"
            
            $faker = Faker\Factory::create("ja_JP");
            
            for( $i=0; $i<10; $i++ ){

                App\Event::create([
					"title" => $faker->word(),
					"insts_id" => $faker->randomDigit(),
					"date" => $faker->date()." ".$faker->time(),
					"start_time" => $faker->word(),
					"end_time" => $faker->word(),
					"dtls" => $faker->word(),
					"img" => $faker->word(),
					"capacity" => $faker->city(),
					"inst_users_id" => $faker->randomDigit(),
					"created_at" => $faker->dateTime("now"),
					"updated_at" => $faker->dateTime("now")
                ]);
            }
        }
    }