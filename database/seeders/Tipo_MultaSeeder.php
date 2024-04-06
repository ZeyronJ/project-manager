<?php

namespace Database\Seeders;

use App\Models\Tipo_Multa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Tipo_MultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipo_Multa::factory()->createMany([[
                'porcentaje_1' => 15,
                'porcentaje_2' => 20,
                'porcentaje_multa' => 1
            ],
            [
                'porcentaje_1' => 20.1,
                'porcentaje_2' => 25,
                'porcentaje_multa' => 1.5
            ],
            [
                'porcentaje_1' => 25.1,
                'porcentaje_2' => 30,
                'porcentaje_multa' => 2
            ]
        ]);
        //
    }
}
