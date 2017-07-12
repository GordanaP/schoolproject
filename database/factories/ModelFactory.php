<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// User
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

// Role
$factory->define(App\Role::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});

// Classroom
$factory->define(App\Classroom::class, function (Faker\Generator $faker) {

    return [
        'label' => str_random(2),
    ];
});

// Student
$factory->define(App\Student::class, function (Faker\Generator $faker) {

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
        'classroom_id' => function(){
            return factory(App\Classroom::class)->create()->id;
        }
    ];
});

// Teacher
$factory->define(App\Teacher::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
    ];
});

// Subject
$factory->define(App\Subject::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
    ];
});
