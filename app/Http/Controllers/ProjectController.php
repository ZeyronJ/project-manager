<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Modificacion;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{


    //Mostrar proyecto

    function show_project($id){
        $project = Project::find($id);
        return view('project.show_project', compact('project'));
    }

    //Cambiar Usuario de proyecto
    function assign_user($id, Request $request){
        $project = Project::find($id);
        if($request->user_assigned){
            $project->user_id = $request->user_assigned;
            $project->save();
            return redirect()->back()->with('success','Asignado con exito');
        }
        else{
            return redirect()->back()->with('danger','Esta asignando el mismo');
        }
        

    }

    //Crear proyecto

    function add_project(){
        return view('project.create_project');
    }

    function adding_project(Request $request){

        foreach($request->all() as $req) {
            error_log($req);
        }

        $fecha_inicio = Carbon::parse($request->startdate);
        $fecha_termino = Carbon::parse($request->enddate);

        error_log($fecha_inicio);
        error_log($fecha_termino);
        error_log($fecha_inicio->diffInMonths($fecha_termino));
        $project = new Project;

        $project->user_id = Auth::id();
        $project->nombre = $request->name;
        $project->costo_total = $request->cost;
        $project->fecha_inicio = $request->startdate;
        $project->fecha_termino = $request->enddate;
        $project->decreto_adjudicacion = $request->decreto_adjudicacion;
        $project->decreto_aprobacion = $request->decreto_aprobacion;
        $project->empresa_constructora = $request->empresa_constructora;
        $project->empresa_contratista = $request->empresa_contratista;
        $project->plazo_de_ejecucion = $request->plazo_de_ejecucion;
        $project->estado = 'En curso';
        $project->pathfile = $request->name;
        
        Storage::makeDirectory('projects/'.$project->nombre);
        Storage::makeDirectory('projects/'.$project->nombre.'/boletas');
        Storage::makeDirectory('projects/'.$project->nombre.'/estadodepago');
        Storage::put('projects/'.$project->nombre.'/contrato.pdf', $project->pathfile);

        $project->save();
        return redirect()->route('home')->with('success','Se agrego el proyecto '. $project->id.' con exito');
    }

    //Editar proyecto

    function edit_project($id){
        $project = Project::find($id);
        
        return view('project.edit_project',compact('project'));
    }

    function editting_project($id, Request $request){
        $project = Project::find($id);
        $project->decreto_adjudicacion = $request->decreto_adjudicacion;
        $project->decreto_aprobacion = $request->decreto_aprobacion;
        $project->empresa_constructora = $request->empresa_constructora;
        $project->empresa_contratista = $request->empresa_contratista;
        $project->plazo_de_ejecucion = $request->plazo_de_ejecucion;
        
        /*
        error_log('projects/'.$project->pathfile);
        error_log('projects/'.$request->name);
        Storage::moveDirectory('projects/'.$project->pathfile, 'projects/'.$request->name);
        Storage::moveDirectory('projects/charity.mosciski', 'projects/'.$request->name);
        Storage::deleteDirectory('projects/'.$project->pathfile);
        */
        
        $project->pathfile = $request->name;
        $project->save();

        if(!$request->search){
            $projects = Project::all();
        }
        else{
            $projects = Project::where('nombre','like',$request->search.'%')->get();
        }
        
        return redirect()->route('home')->with('success','Se edito el proyecto '. $project->id.' con exito');
    }

    function switch_project($id){
        $project = Project::find($id);

        if ($project->estado == 'En curso'){
            $project->estado = 'desactivado';
        }
        else{
            $project->estado = 'En curso';
        }

        $project->save();
        return redirect()->back();
    }

    function delete_project($id){
        $project = Project::find($id);

        Storage::deleteDirectory('projects/'.$project->pathfile);
        $project->delete();
        return redirect()->back();
    }
    

    //
}
