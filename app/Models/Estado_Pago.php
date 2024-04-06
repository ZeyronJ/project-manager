<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado_Pago extends Model
{
    protected $table = 'estados_pago';
    protected $fillable = ['avance_programado', 'avance_actual', 'fecha', 'pathfile'];
    use HasFactory;

    // registra los cambios en la tabla de historial
    protected static function boot()
    {
        parent::boot();

        static::updated(function ($model) {
            $changes = $model->getDirty();

            if(array_key_exists('fecha', $changes) ||
            array_key_exists('avance_programado', $changes) ||
            array_key_exists('avance_actual', $changes) ||
            array_key_exists('porcentaje_diferencia', $changes)){
                // crea un nuevo registro en la tabla de historial solo si cambiaron los atributos especificados
                EstadoPagoHistorial::create([
                    'estado_pago_id' => $model->id,
                    'project_id' => $model->getOriginal('project_id'),
                    'multa_id' => $model->getOriginal('multa_id'),
                    'fecha' => $model->getOriginal('fecha'),
                    'avance_programado'  => $model->getOriginal('avance_programado') ,
                    'avance_actual'  => $model->getOriginal('avance_actual') ,
                    'porcentaje_diferencia'  => $model->getOriginal('porcentaje_diferencia') ,
                    'pathfile'  => $model->getOriginal('pathfile') ,
                ]);
            }
            
        });
        
    }

    public static function multas_sin_cursar(){
        $proyectos = Project::get();

        foreach ($proyectos as $proyecto) {
            $estados_pago = Estado_Pago::where('project_id', $proyecto->id)->get();
            $tipos_multa = Tipo_Multa::orderBy('porcentaje_1', 'asc')->get();

            $cont=0;
            foreach ($estados_pago as $estado_pago) {
                $estado_pago->dif = round((1 - ($estado_pago->avance_actual / $estado_pago->avance_programado))*100,2);
                foreach($tipos_multa as $tm){
                    if(($tm->porcentaje_1 <= $estado_pago->dif && $estado_pago->dif <= $tm->porcentaje_2)){
                        $cont++;
                    }
                }
                $ultimo = $tipos_multa[count($tipos_multa) - 1];
                if($estado_pago->dif > $ultimo->porcentaje_2){
                    $cont++;
                }
            }
            if($cont>0){
                session(["notificaciones_multas_sin_cursar_".$proyecto->id => $cont]);
            }
            else{
                session()->forget("notificaciones_boletas_por_vencer_".$proyecto->id);
            }
        }
    }
}
