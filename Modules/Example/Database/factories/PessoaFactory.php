<?php

namespace Modules\Example\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Example\Entities\Pessoa;

class PessoaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pessoa::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'active' => $this->faker->randomElement([false, true]),
        ];
    }
}

