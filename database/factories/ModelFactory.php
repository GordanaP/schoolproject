<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//User
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    $first = strtolower($faker->firstName);
    $last = strtolower($faker->lastName);
    $name = $first . '-' .$last;
    $email = $first . '.' .$last.'@gmail.com';

    return [
        'name' => $name,
        'email' => $email,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

//Role
$factory->define(App\Role::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});
