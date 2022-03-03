<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use Faker\Factory as Faker;

class CategoriaSeeder extends Seeder
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
            DB::table('categorias')->insert([
                'categoria' => $faker->name(),
            ]);
        }
    }
}
