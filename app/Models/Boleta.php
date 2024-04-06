<?php

namespace App\Models;

use App\Mail\MailPM;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Boleta extends Model
{
    public static function diferencia_meses($fecha1, $fecha2){
        $date1 = Carbon::parse($fecha1);
        $date2 = Carbon::parse($fecha2);
        $diff  = $date1->diffInDays($date2);
        return $diff;
    }
    public static function boletas_por_vencer_general(){
        $proyectos = Project::get();

        foreach ($proyectos as $proyecto) {
            $boletas = Boleta::where('project_id', $proyecto->id)->get();
            $cont=0;
            foreach ($boletas as $boleta) {
                if(Boleta::diferencia_meses($boleta->fecha_termino, date('Y-m-d'))<30 && $boleta->fecha_termino>=date('Y-m-d') && $boleta->estado!=1){
                    $cont++;
                }
            }
            if($cont!=0){
                session(["notificaciones_boletas_por_vencer_".$proyecto->id => $cont]);
            }
            else{
                session()->forget("notificaciones_boletas_por_vencer_".$proyecto->id);
            }
        }
    }
    public static function boletas_por_vencer_correo(){
        $proyectos = Project::get();

        foreach ($proyectos as $proyecto) {
            $boletas = Boleta::where('project_id', $proyecto->id)->get();
            $cont=0;
            foreach ($boletas as $boleta) {
                if(Boleta::diferencia_meses($boleta->fecha_termino, date('Y-m-d'))<30 && $boleta->fecha_termino>date('Y-m-d') && $boleta->estado!=1){
                    $cont++;
                }
            }
            if($cont>0){
                $emailData = [
                    'title' => "Boletas por vencer",
                    'body' => "Hay boletas por vencer",
                ];
                // Mail::to("correos")->send(new MailPM($emailData));
                $correos = DB::table('users')
                ->join('projects', 'users.id', '=', 'projects.user_id')
                ->select('users.email')
                ->where('projects.id', '=', $proyecto->id)
                ->get();
                Mail::to($correos)->send(new MailPM($emailData));
                Log::info("Se envia correo");
            }
        }
    } 

    public static function boletas_por_vencer_proyecto($id_project){
        $project = Project::find($id_project);
        $flag  = 0;
        $boletas = Boleta::where('project_id', $project->id)->get();
        foreach ($boletas as $boleta) {
            if($boleta->estado==2){
                $flag=1;
            }
        }
        if($flag!=0){
            session(["notificaciones_boletas_por_vencer_proyecto" => 1]);
        }
        else{
            session()->forget('notificaciones_boletas_por_vencer_proyecto');
        }
    }
    public static function boletas_estado($id_boleta, $flag){
        $boleta = Boleta::find($id_boleta);

        if($boleta->fecha_termino < date('Y-m-d') && ($boleta->estado!=1 || $flag==1) && $boleta->estado!=3){
            $boleta->estado=3;
            $boleta->save();
        }
        else if($boleta->diferencia_meses($boleta->fecha_termino,date('Y-m-d')) < 30 && ($boleta->estado!=1 || $flag==1) && ($boleta->fecha_termino>=date('Y-m-d'))){
            $boleta->estado=2;
            $boleta->save();
        }
        else if($boleta->diferencia_meses($boleta->fecha_termino,date('Y-m-d')) > 30 && ($boleta->estado!=1 || $flag==1) && ($boleta->fecha_termino>=date('Y-m-d'))){
            $boleta->estado=0;
            $boleta->save();
        }
    }
    // public static function boletas_modificacion_proyecto($id_project){
    //     $boletas = Boleta::where('project_id', $id_project)->get();
    //     foreach($boletas as $boleta){
    //         if($boleta->estado!=1){
    //             $boleta->estado=2;
    //         }
    //         $boleta->save();
    //     }
    // }
    use HasFactory;
}
