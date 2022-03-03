<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Produto;
use Faker\Factory as Faker;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            DB::table('produtos')->insert([
                'nome' => $faker->name(),
                'preco' => $faker->numberBetween(1, 10),
                'descricao' => $faker->text(),
                'quantidade' => $faker->numberBetween(1, 10),
                'imagem' => '',
                'categoria_id' => $faker->numberBetween(1, 10)
            ]);
        }
    }
}
