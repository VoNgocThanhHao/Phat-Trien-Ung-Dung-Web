<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Võ Ngọc Thanh Hào",
            'email' => "haovnt187@gmail.com",
            'password' => bcrypt("123456"),
            'permission' => 3,
        ]);

        DB::table('profiles')->insert([
            'image' => "public/mySource/imgs/avatars/unknow.jpg",
            'user_id' => 1,
        ]);
    }
}
