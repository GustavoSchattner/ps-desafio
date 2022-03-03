<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdutoFactory extends Factory
{


    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'preco' => $this->faker->unique()->numberBetween(1, 10),
            'descricao' => $this->faker->text(),
            'quantidade' => $this->faker->unique()->numberBetween(1, 10),
            'imagem' => '',
            'categoria_id ' => $this->faker->unique()->numberBetween(1, 10)
        ];
    }
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
