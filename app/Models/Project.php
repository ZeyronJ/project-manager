<?php

namespace App\Models;

use App\Mail\MailPM;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class Project extends Model
{
    public static function diferencia_meses($fecha1, $fecha2){
        $date1 = Carbon::parse($fecha1);
        $date2 = Carbon::parse($fecha2);
        $diff  = $date1->diffInDays($date2);
        return $diff/30;
    }
    
    public static function proyecto_fecha_limite(){
        $projects = Project::get();
        
        foreach($projects as $project){
            if(Project::diferencia_meses($project->fecha_termino, now()) < 5){
                session(["notificaciones_proyecto_fecha_limite_".$project->id => "El proyecto ".$project->nombre." está por vencer, quedan ".Project::diferencia_meses($project->fecha_termino, now())." meses"]);
            } else {
                session()->forget("notificaciones_proyecto_fecha_limite_".$project->id);
            }
        }
    }
    

    public static function proyectos_por_vencer_correo(){
        $projects = Project::get();

        foreach ($projects as $project) {            
            if(Project::diferencia_meses($project->fecha_termino, now())<30){
                $emailData = [
                    'title' => "Fecha límite del proyecto ".$project->name." por vencer",
                    'body' => "Se recomienda realizar modificación o archivar proyecto",
                ];
                // Mail::to("correos")->send(new MailPM($emailData));
                $correos = DB::table('users')
                ->join('projects', 'users.id', '=', 'projects.user_id')
                ->select('users.email')
                ->where('projects.id', '=', $project->id)
                ->get();
                Mail::to($correos)->send(new MailPM($emailData));
                Log::info("Se envia correo");
            }
        }
    }
    

    public static function get_name($id){
        $user = User::find($id);
        return $user->name;
    }
    use HasFactory;
}
