<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for($i=0;$i<5;$i++){
       	User::create([
       		"email" => "user".$i."@gmail.com",
       		"password" => \Hash::make("12345678"),
       		"name" => "user".$i,
       		"facebook" => "https://facebook.com",
       		"instagram" => "https://instagram.com",
          "youtube" => "https://youtube.com",
          "twitter" => "https://twitter.com",
          "blogger" => "https://blogger.com",
       		"photo" => "default.png",
       		"about" => "About Me",
       		"is_active" => $i == 1 ? true : false
       	]);
       }
    }
}
