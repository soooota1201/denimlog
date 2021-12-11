<?php

use Illuminate\Database\Seeder;

class DenimsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('denims')->insert(
            [
                'user_id'       =>  1,
                'bland_type'    => 'nudiejeans',
                'waist'         => 31,
                'wearing_count' => 10
            ],
        );

    }
}
