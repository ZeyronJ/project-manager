<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Modificacion;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ModificacionController extends Controller
{
    function show_modificaciones($id){
        $project = Project::find($id);
        $modificaciones = Modificacion::where('project_id','=',$id)->get();
        return view('project.modificaciones.index',compact('project','modificaciones'));
    }
    

    function modificar_proyecto($id){
        $project = Project::find($id);
        return view('project.modificaciones.add_modification',compact('project'))->with('tipo',0);
    }

    function solicitar_modificacion($id,Request $request){
        $project = Project::find($id);                
        
        $modificacion = new Modificacion();
        $modificacion->project_id = $project->id;
        $modificacion->decreto_aprobacion = $request->decreto;
        // 1 solo plazo, 2 plazo y costo, 3 solo costo
        if($request->plazo){
            $modificacion->tipo = 1;

            $modificacion->fecha_modificacion = now();
            $modificacion->dias = $request->days;

            
            $project->fecha_termino = Carbon::parse($project->fecha_termino)->addDays($modificacion->dias);
            $project->plazo_de_ejecucion = $project->plazo_de_ejecucion + $modificacion->dias;

            if($request->costo){
                $modificacion->monto = $request->cost;
                $modificacion->tipo = 2;
                
                $project->costo_total = $project->costo_total + $modificacion->monto;
            }
            
            $modificacion->save();            
            $project->save();
            
            return redirect()->route('project.modificacion.index', ['id' => $project->id]);
        }

        if($request->costo){
            $modificacion->monto = $request->cost;
            $modificacion->tipo = 3;

            $project->costo_total = $project->costo_total + $modificacion->monto;

            $modificacion->save();
            $project->save();
            return redirect()->route('project.modificacion.index', ['id' => $project->id]);
        }

        return redirect()->back()->with('danger','No se escogio tipo');
    }
/* 
    function aprobar_modificacion($id){
        $modificacion = Modificacion::find($id);
        $modificacion->estado = 'aprobado';
        $modificacion->save();

        $project = Project::find($modificacion->project_id);

        if($modificacion->tipo == 1){
            //Tipo 1 Plazo
            $project->fecha_termino = $modificacion->nuevo_termino;
            $project->plazo_de_ejecucion = $modificacion->nuevo_plazo;
        }else if($modificacion->tipo == 2){
            //Tipo 2 Costo y Plazo
            $project->fecha_termino = $modificacion->nuevo_termino;
            $project->plazo_de_ejecucion = $modificacion->nuevo_plazo;

            $project->costo_total = $modificacion->nuevo_costo;
            
        }else{
            //Tipo 3 Costo
            $project->costo_total = $modificacion->nuevo_costo;
        }
        $project->save();
        Boleta::boletas_modificacion_proyecto($project->id);
        return redirect()->back()->with('success','Se modifico correctamente, actualice las boletas por favor');
    }
     */
    //
}
