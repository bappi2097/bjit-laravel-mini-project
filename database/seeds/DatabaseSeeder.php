<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "bappi saha",
            "email" => "admin@example.com",
            "password" => bcrypt('password'),
            "is_admin" => true
        ]);


        // $this->call(UsersTableSeeder::class);
    }
}
