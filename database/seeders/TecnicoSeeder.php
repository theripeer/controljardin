<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Tecnico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TecnicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecnico = Tecnico::create([
            'name' =>'Cuadrilla 1',
            'email' =>'cua1@email.com',
            'password' => bcrypt('password'),
        ]);

        $tecnico->empresas()->attach(Empresa::where('slug', 'ajn')->first());


        $tecnico2 = Tecnico::create([
            'name' =>'Cuadrilla 2',
            'email' =>'cua2@email.com',
            'password' => bcrypt('password'),
        ]);

        $tecnico2->empresas()->attach(Empresa::where('slug', 'ajn')->first());
        $tecnico2->empresas()->attach(Empresa::where('slug', 'm2')->first());


    }
}
