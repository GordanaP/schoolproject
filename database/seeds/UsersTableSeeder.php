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
        factory(App\User::class, 5)->create();

        factory(App\User::class)->create([
            'name'=> 'gordana-vlajkovic',
            'email' => 'gordana.vlajkovic@gmail.com'
        ]);
    }
}
