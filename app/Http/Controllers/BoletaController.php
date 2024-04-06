<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoletaController extends Controller
{
    function index($id){
        $project = Project::find($id);
        $boletas = Boleta::where('project_id', $project->id)->get();
        Boleta::boletas_por_vencer_proyecto($id); // Maneja las notificaciones desde la pagina de boletas
        return view('project.boletas.index', compact('project','boletas'));
    }
    function store(Request $req, $id){

        $req->validate([
            "glosa"        => ["required"],
            "type"         => ["required"],
            "number"       => ["required"],
            "monto"        => ["required"],
            "fecha_inicio" => ["required"],
            "fecha_fin"    => ["required"],
            "file"         => ["required"],
        ]);

        $project = Project::find($id);
        $project_name = $project->nombre;

        $file = $req->file("file");

        $boleta       = new Boleta;
        $boleta->glosa       = $req->string("glosa");
        $boleta->tipo        = $req->string("type");
        $boleta->numero        = $req->string("number");
        $boleta->monto         = $req->integer("monto");
        $boleta->fecha_inicio  = $req->date("fecha_inicio");
        $boleta->fecha_termino = $req->date("fecha_fin");
        $boleta->pathfile      = "/projects/" . $project_name . "/boletas/" . $file->getClientOriginalName();
        $boleta->project_id    = $project->id;
        $boleta->save();
        $file->storeAs("/projects/".$project_name."/boletas", $file->getClientOriginalName());

        $boleta->boletas_estado($boleta->id, 0);

        return redirect()->route('project.boletas', ['id'=>$id])->with('success','Se guardo la boleta exitosamente');
    }
    function destroy($id, $boleta_id){
        $boleta  = Boleta::find($boleta_id);
        Storage::disk('local')->delete($boleta->pathfile);
        $boleta->delete();

        return redirect()->route('project.boletas', ['id'=>$id])->with('success','Se elimino la boleta exitosamente');
    }
    function update(Request $req, $project_id, $boleta_id){

        $project = Project::find($project_id);
        $project_name = $project->nombre;

        $boleta     = Boleta::find($boleta_id);
        $boleta->glosa         = $req->string("glosa");
        $boleta->tipo          = $req->string("type");
        $boleta->numero        = $req->string("number");
        $boleta->monto         = $req->integer("monto");
        $boleta->fecha_inicio  = $req->date("fecha_inicio");
        $boleta->fecha_termino = $req->date("fecha_fin");
        if($req->file("file")){
            Storage::disk('local')->delete($boleta->pathfile);
            
            $file    = $req->file("file");
            $boleta->pathfile = "/projects/" . $project_name . "/boletas/" . $file->getClientOriginalName();
            $file->storeAs("/projects/".$project_name."/boletas", $file->getClientOriginalName());
        }
        $boleta->save();
        $boleta->boletas_estado($boleta->id, 0);
        return redirect()->route('project.boletas', ['id'=>$project_id])->with('success','Se guardo la boleta exitosamente');

    }
    function approve($project_id, $boleta_id){
        $boleta  = Boleta::find($boleta_id);
        $boleta->estado=1;
        $boleta->save();

        return redirect()->route('project.boletas', ['id'=>$project_id])->with('success','Se desactivo la boleta exitosamente');
    }
    function disapprove($project_id, $boleta_id){
        $boleta  = Boleta::find($boleta_id);
        $boleta->boletas_estado($boleta_id, 1);

        return redirect()->route('project.boletas', ['id'=>$project_id])->with('success','Se activo la boleta exitosamente');
    }

    function download(Request $request) {
        return Storage::download($request->pathfile);
    }
}
