<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'     => 'denimlog',
                'email'    => 'denimlog@example.com',
                'password' => Hash::make('12345678'),
            ],
        );

        // factory(App\User::class, 10)->create()
        // ->each(function ($user) {
        //     $user->denims()->createMany(factory(App\Denim::class, 5)->make()->toArray()
        //     );
        // });
    }
}
