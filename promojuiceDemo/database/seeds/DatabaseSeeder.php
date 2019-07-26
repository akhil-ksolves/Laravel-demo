<?php

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
        DB::table('users')->insert([
            'name' => 'akhil',
            'email' => 'akhil.singhal@ksolves.com',
            'phone' => '9627965625',
            'password' => md5('Welcome'),
        ]);
    }
}
