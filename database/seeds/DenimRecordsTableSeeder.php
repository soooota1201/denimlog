<?php

use Illuminate\Database\Seeder;

class DenimRecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\DenimRecord::class, 1)->create();
    }
}
