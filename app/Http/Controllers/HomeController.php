<?php

namespace App\Http\Controllers;

use App\Models\Boleta;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    function index(Request $request){
        if(Auth::id() == 1 or User::find(Auth::id())->hasRole('lector')){
            $projects = Project::all();
        }else{
            $projects = Project::where('user_id','=',Auth::id())->get();
        }

        if($request->search){
            $projects = Project::where('nombre','like',$request->search.'%')->get();                
        }
        
        Boleta::boletas_por_vencer_general();
        Project::proyecto_fecha_limite();
        return view('projects_view', compact('projects'));
    }

}
