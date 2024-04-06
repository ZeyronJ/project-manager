<?php

namespace Database\Seeders;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = Project::factory(5)->create();
        
        Storage::deleteDirectory('projects');
        Storage::makeDirectory('projects');
        foreach($projects as $project){
            Storage::makeDirectory('projects/'.$project->nombre);
            Storage::makeDirectory('projects/'.$project->nombre.'/'.'boletas');
            Storage::makeDirectory('projects/'.$project->nombre.'/'.'estados_de_pago');

            for($i = 1; $i <= 5; $i++){
                Storage::put('projects/'.$project->nombre.'/'.'boletas/boletatest'.$i.'.pdf', 'hola soy una boleta '.$i);
                Storage::put('projects/'.$project->nombre.'/'.'estados_de_pago/estadopagotest'.$i.'.pdf', 'hola soy un estado pago '.$i);

            }
            Storage::put('projects/'.$project->nombre.'/'.'test'.$i.'.pdf', 'hola soy un pdf '.$i);
            error_log($project->nombre);
        }
        //
    }
}
