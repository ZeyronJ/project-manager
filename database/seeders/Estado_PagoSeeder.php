<?php

namespace Database\Seeders;

use App\Models\Estado_Pago;
use App\Models\Multa;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class Estado_PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::find(1);

        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'avance_programado' => 1000000,
            'avance_actual' => 840000,
            'pathfile' => 'projects/'.$project->nombre.'/estados_de_pago/'.'estadopagotest1.pdf'
        ]);
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'avance_programado' => 1000000,
            'avance_actual' => 750000,
            'pathfile' => 'projects/'.$project->nombre.'/estados_de_pago/'.'estadopagotest2.pdf'
        ]);

        for($i = 3;$i <= 5 ; $i++){
            Estado_Pago::factory()->create([
                'project_id' => $project->id,
                'avance_programado' => 1000000,
                'avance_actual' => 1000000,
                'pathfile' => 'projects/'.$project->nombre.'/estados_de_pago/'.'estadopagotest'.$i.'.pdf'

            ]);
        }
        
        $project = Project::factory()->create([
            'nombre' => "Ampliación casa central",
            'costo_total' => 1652480340,
            'fecha_inicio' => Carbon::create(2022, 1, 9)->format('Y-m-d'),
            'estado' => 'En curso',
            'pathfile' => 'Ampliación casa central'
        ]);
        Storage::makeDirectory('projects/'.$project->nombre);
        Storage::makeDirectory('projects/'.$project->nombre.'/'.'boletas');
        Storage::makeDirectory('projects/'.$project->nombre.'/'.'estados_de_pago');
        $inicio = Carbon::createFromformat('Y-m-d', $project->fecha_inicio);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 52879372,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 79319056,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 92538900,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 158638113,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 198297641,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 257786932,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 178467877,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 148723231,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 133850908,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
        $inicio->addMonth();
        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'fecha' => $inicio,
            'avance_programado' => 104106262,
            'avance_actual' => 0,
            'pathfile' => ''
        ]);
    }
}
