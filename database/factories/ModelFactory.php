<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {

    $mail = $faker->unique()->safeEmail;
    return [
        'login'             => $mail,
        'email'             => $mail,
        'password'          => bcrypt('password'),
        'remember_token'    => str_random(32),
        'role'              => 1,
        'balance'           => 0,
        'ref_link'          => $faker->uuid,
        'last_activity'     => \Carbon\Carbon::now(),
        'referral_id'       => rand(0, 10) < 8 ? \App\Models\User::inRandomOrder()->first()->id : null,
    ];
});
