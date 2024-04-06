<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modificacion extends Model
{
    protected $table = 'modificaciones';
    use HasFactory;

    public static function diferencia_meses($fecha1, $fecha2){
        $date1 = Carbon::parse($fecha1);
        $date2 = Carbon::parse($fecha2);
        $diff  = $date1->diffInDays($date2);
        return $diff;
    }
/* 
    public static function modificaciones_fecha_limite($id_project){
        $project = Project::find($id_project);
        $flag  = 0;
        $modificaciones = Modificacion::where('project_id', $project->id)->where('estado','aprobacion')->get();
        foreach ($modificaciones as $modificacion) {
            if(Modificacion::diferencia_meses($modificacion->nuevo_termino, $project->fecha_termino)<30){
                $flag=1;
            }
        }
        if($flag>0){
            session(["notificaciones_modificacion_fecha_limite" => "Existe modificacion por vencer en el proyecto ".$project->nombre]);
        }
        else{
            session()->forget('notificaciones_modificacion_fecha_limite');
        }
    }
     */
}
