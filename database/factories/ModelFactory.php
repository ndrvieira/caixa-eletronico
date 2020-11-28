<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Account;
use Faker\Generator as Faker;
use Faker\Provider\pt_BR\Person as FakerBr;
use Faker\Provider\DateTime as FakerDate;

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

$factory->define(User::class, function (Faker $faker, FakerBr $fakerBr, FakerDate $fakerDate) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'cpf' => $fakerBr->cpf,
        'password' => $faker->password(4, 10),
        'birth_date' => $fakerDate->date('Y-m-d', 'now')
    ];
});

$factory->define(Account::class, function (Faker $faker, FakerBr $fakerBr, FakerDate $fakerDate) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'cpf' => $fakerBr->cpf,
        'password' => $faker->password(4, 10),
        'birth_date' => $fakerDate->date('Y-m-d', 'now')
    ];
});
