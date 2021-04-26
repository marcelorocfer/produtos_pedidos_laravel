<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->unique()->word,
        'preco' => $faker->numberBetween($min = 50, $max = 50000),
        'foto' => $faker->image('public/storage/fotos', 640, 480)
    ];
});
