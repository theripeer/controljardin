<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Especie;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        $tecnico = Especie::create([
            'empresa_id' =>'Cuadrilla 1',
            'name' =>'Abies alba',
            'is_visible' => bcrypt('password'),
        ]);*/

        $jardin = User::factory()->create([
            'name' => 'AJN',
            'email' => 'jardin@email.com',
        ]);

        $jardin->empresas()->attach(Empresa::where('slug', 'ajn')->first());


    }
}
