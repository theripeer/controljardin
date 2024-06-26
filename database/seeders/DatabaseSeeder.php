<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            EmpresaSeeder::class,
        ]);

        $this->call(
            TecnicoSeeder::class
        );

        $this->call(
            EspecieSeeder::class
        );

        
        /*
        $trasat = User::factory()->create([
            'name' => 'M2',
            'email' => 'm2@email.com',
        ]);
        $trasat->empresas()->attach(Empresa::where('slug', 'm2')->first());
        */
        /*
        $multicompany = User::factory()->create([
            'name' => 'Admin',
            'email' => 'adm@email.com',
        ]);*/

        //$multicompany->empresas()->attach(Empresa::where('slug', 'm2')->first());
        //$multicompany->empresas()->attach(Empresa::where('slug', 'ajn')->first());

        /*
        */

    }
}
