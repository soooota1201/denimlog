<?php

use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'denimlog',
            'email' => 'denimlog@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
