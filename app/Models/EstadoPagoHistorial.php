<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoPagoHistorial extends Model
{
    use HasFactory;

    protected $table = 'estados_pago_historial';
    protected $fillable = [
        'estado_pago_id', 
        'project_id', 
        'multa_id', 
        'fecha', 
        'avance_programado', 
        'avance_actual', 
        'porcentaje_diferencia',
        'pathfile',
        // aquí puedes agregar cualquier otro campo que quieras guardar en el historial
    ];
}
