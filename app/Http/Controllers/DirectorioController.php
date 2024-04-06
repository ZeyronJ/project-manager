<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Modificacion;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectorioController extends Controller
{
    //Directorio
    function index($id,$dirname, Request $request){
        $project = Project::find($id);
        
        $folders = Storage::directories('projects'.'/'.str_replace('_','/',$dirname));
        $files = Storage::files('projects'.'/'.str_replace('_','/',$dirname));
        $arraux = [];

        if(!$request->search){

            foreach($folders as $folder){
                $folder = explode('/',$folder)[count(explode('/',$folder))-1];
                array_push($arraux,$folder);
            }
            $folders = $arraux;

            $arraux = [];
            foreach($files as $file){
                $file = explode('/',$file)[count(explode('/',$file))-1];
                array_push($arraux,strtok($file,'.'));
            }
            $files = $arraux;
        }
        else{

            foreach($folders as $folder){
                $folder = explode('/',$folder)[count(explode('/',$folder))-1];
    
    
                if(strcasecmp($request->search,$folder) == 0){
        
                    array_push($arraux,$folder);
                }
            }


            $folders = $arraux;

            $arraux = [];
            foreach($files as $file){
                $file = explode('/',$file)[count(explode('/',$file))-1];
                if(strcasecmp($request->search,$file) == 0){
                    array_push($arraux,strtok($file,'.'));
                }
            }
            $files = $arraux;            
        }

        #error_log($folders[0]);
        #Modificacion::modificaciones_fecha_limite($id);
        //return Storage::allDirectories('projects'.'/'.$project->nombre);
        Boleta::boletas_por_vencer_proyecto($id);

        return view('project.directorio.project_dashboard', compact('project','folders','files','dirname'));
    }
    
    //Files
    function store($id, Request $request){
        $file = $request->file("file");

        if($request->name){
            $file->storeAs('/projects'.'/'.str_replace('_','/',$request->dirname)."/", $request->name.'.pdf');
        }else{
            $file->storeAs('/projects'.'/'.str_replace('_','/',$request->dirname)."/", $file->getClientOriginalName());
        }

        return redirect()->back();
    }

    function delete($id,$dirname,$name){
        $project = Project::find($id);
        #error_log('projects/'.str_replace('_','/',$dirname).'/'.$name.'.pdf');
        Storage::delete('projects/'.str_replace('_','/',$dirname).'/'.$name.'.pdf');
        #error_log('projects/'.$project->pathfile.'/'.$name.'.pdf');
        return redirect()->back();
    }

    function download($id,$name){
        $project = Project::find($id);
        error_log('link projects/'.$project->pathfile.'/'.$name.'.pdf');
        return Storage::download('projects/'.$project->pathfile.'/'.$name.'.pdf');
    }

    //Folders

    function create_folder($id,Request $request){
        
        $project = Project::find($id);        
        Storage::makeDirectory("/projects/".$project->nombre."/".$request->name);

        return redirect()->back();
    }
    //
}
