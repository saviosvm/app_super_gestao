<?php

namespace Database\Factories;

use App\Models\SiteContato;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteContatoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SiteContato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [ //o tipo de dado está na documentação do gitHub
            'nome' => $this->faker->name,
            'telefone' => $this->faker->tollFreePhoneNumber, 
            'email' => $this->faker->unique()->email, //colocando o unique dizemos que será de modo unico e não poderá se repetir
            'motivo_contato' => $this->faker->numberBetween(1,3), //valor entre e inclusive 1 e 3
            'mensagem' => $this->faker->text(200),
        ];
    }
}
