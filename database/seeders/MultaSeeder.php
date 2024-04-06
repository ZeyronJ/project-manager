<?php

namespace Database\Seeders;

use App\Models\Estado_Pago;
use App\Models\Multa;
use App\Models\Tipo_Multa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MultaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipo1 = Tipo_Multa::find(1);
        $tipo2 = Tipo_Multa::find(2);

        $estadopago1 = Estado_Pago::find(1);
        $estadopago2 = Estado_Pago::find(2);

        Multa::factory()->createMany([[
                'tipo_multa_id' => $tipo1->id,
                'monto' => $estadopago1->avance_programado * $tipo1->porcentaje_multa,
                'pagado' => 0
        ],
        [
            'tipo_multa_id' => $tipo2->id,
            'monto' => $estadopago2->avance_programado * $tipo2->porcentaje_multa,
            'pagado' => 0
        ]
        ]);

        $multa1 = Multa::find(1);
        $multa2 = Multa::find(2);

        $estadopago1->multa_id = $multa1->id;
        $estadopago2->multa_id = $multa2->id;
        //
    }
}

