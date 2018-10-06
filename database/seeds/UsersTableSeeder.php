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
        // factory(App\User::class, 50)->create();

        for ($i = 1; $i < 40; $i++) {
            $number = sprintf('%03d', $i);

            factory(App\User::class)->create([
                'name' => 'User',
                'email' => 'user' . $number . '@email.com',
            ]);
        }
    }
}
