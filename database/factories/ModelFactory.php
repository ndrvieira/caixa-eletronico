<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Account;
use App\Models\AccountType;
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

$factory->define(User::class, function (Faker $faker) {
    $faker->addProvider(new FakerBr($faker));
    $faker->addProvider(new FakerDate($faker));
    return [
        'name' => $faker->name,
        'cpf' => $faker->unique()->cpf,
        'birth_date' => $faker->date('Y-m-d', 'now')
    ];
});

$factory->define(Account::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(User::pluck('id')),
        'account_type_id' => $faker->randomElement(AccountType::pluck('id')),
        'amount' => $faker->numberBetween(10, 50000)
    ];
});