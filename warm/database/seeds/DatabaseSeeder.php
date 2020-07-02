<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //********************************************
        // Cmd:[ php artisan db:seed ]
        //********************************************
        // $this->call(UsersTableSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(EventsTableSeeder::class);
		$this->call(QuerysTableSeeder::class);
		$this->call(InstsTableSeeder::class);
		$this->call(StudentsTableSeeder::class);
		$this->call(NationsTableSeeder::class);
		$this->call(InstUsersTableSeeder::class);
		$this->call(BooksTableSeeder::class);
		$this->call(TermsTableSeeder::class);
		$this->call(PasswordResetsTableSeeder::class);
		$this->call(LevelsTableSeeder::class);
		$this->call(SubjectsTableSeeder::class);
   }
}