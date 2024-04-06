<?php

namespace Database\Seeders;

use App\Models\Boleta;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoletaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Project::find(1);
        for($i = 1;$i <= 5 ; $i++){
            Boleta::factory()->create([
                'project_id' => $project->id,
                'numero'=>$project->nombre[1].$i,
                'glosa'=>"Correcta ejecucion de obra",
                'tipo'=> "Certificado de Fianza",
                'monto' => 1000000,
                'pathfile' => '/projects/'.$project->nombre.'/boletas/'.'/boletatest'.$i.'.pdf'
            ]);
        }
        //
    }
}
