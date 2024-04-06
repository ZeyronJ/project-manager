<?php

namespace App\Http\Controllers;

use App\Models\Estado_Pago;
use App\Models\Project;
use App\Models\Multa;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MultaController extends Controller
{
    function index(){
        
    }

    function store(Request $request){


        $nueva_multa = Multa::factory()->createOne([
            'tipo_multa_id' => $request->tipo_multa_id,
            'monto' => (int)$request->monto_multa,
            'pagado' => (int)0,
        ]);

        $ep = Estado_Pago::find($request->estado_pago_id);
        $ep->multa_id = $nueva_multa->id;
        $ep->save();

        return redirect()->route('project.estados_pago', [ 'id' => $request->id ])->with('success', 'Multa aplicada correctamente!');
    }

    function delete(Request $request){
        $estado_pago = Estado_Pago::find($request->estado_pago_id);
        $multa =  Multa::find($estado_pago->multa_id);
        $estado_pago->multa_id = null;
        $estado_pago->save();
        $multa->delete();

        return redirect()->route('project.estados_pago', [ 'id' => $request->id ])->with('success', 'Multa eliminada correctamente!');
    }
    
    function update(Request $request){
        
        $mt = Multa::find($request->multa_id);
        $mt->monto = $request->monto_multa;
        $mt->pagado = $request->monto_pagado;
        $mt->save();

        return redirect()->route('project.estados_pago', [ 'id' => $request->id ])->with('success', 'Multa actualizada correctamente!');
    }
}
