<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = ['Fiat', 'Volkswagen', 'Hyundai'];

        foreach ($marcas as $marca) {
            Marca::firstOrCreate(['nome' => $marca])->save();
        }
    }
}
