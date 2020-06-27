<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fotografer;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Fotografer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'username' => $faker->userName,
        'email' => $faker->unique()->email,
        'foto' => $faker->name,
        'kontak' => $faker->phoneNumber,
        'alamat' => $faker->address,
        'password' => password_hash('123', PASSWORD_BCRYPT),
    ];
});
