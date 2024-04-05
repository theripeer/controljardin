<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ALTO JARDIN
        Empresa::create([
            'name' => 'AJN',
            'slug' =>'ajn'
        ]);

        //Empresa 2
        Empresa::create([
            'name' => 'M2',
            'slug' =>'m2'
        ]);
    }
}
