<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreEstadoPagoRequest;
use App\Models\Estado_Pago;
use App\Models\EstadoPagoHistorial;
use App\Models\Project;
use App\Models\Multa;
use App\Models\Tipo_Multa;
use Carbon\Carbon;
use Error;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class EstadoPagoController extends Controller
{
    function regenerate(Request $request){
        $project = Project::find($request->id);
        $estados_pago = Estado_Pago::where('project_id', $project->id)->orderBy('fecha', 'asc')->get();
        $count = $estados_pago->count();
        $num_meses = $request->input("num_meses");
        error_log('NM: '.$num_meses);
        if($num_meses < count($estados_pago)){
            for($i = count($estados_pago) - 1; $i > $num_meses - 1; $i--){
                $aux = Estado_Pago::find($estados_pago[$i]->id);
                $aux->delete();
                $estados_pago = Estado_Pago::where('project_id', $project->id)->orderBy('fecha', 'asc')->get();
                error_log('--'.$estados_pago->count());
            }
        }
        $estados_pago = Estado_Pago::where('project_id', $project->id)->orderBy('fecha', 'asc')->get();
        error_log($estados_pago->count());
        for($j = 0; $j < $num_meses; $j++){
            //error_log($request->input("avance_programado".$i) !== null);
            //error_log($request->input("avance_programado".$i));
            if($j >= count($estados_pago)){
                error_log('crear');
                $f = Carbon::createFromformat('Y-m-d', $estados_pago[$j - 1]->fecha);
                $f->addMonth();
                Estado_Pago::factory()->create([
                    'fecha' => $f,
                    'project_id' => $project->id,
                    'avance_programado' => $request->input('avance_programado'.$j),
                    'avance_actual' => 0,
                    'pathfile' => '',
                ]);
            } else {
                error_log('actualizar');
                $estados_pago[$j]->avance_programado = $request->input("avance_programado".$j);
                $estados_pago[$j]->save();
            }
        }
        
        return redirect()->route('project.estados_pago', ['id'=>$project->id])->with('success', 'estados de pago actualizados correctamente!');
    }

    function generate(Request $request){
        $num_meses = $request->num_meses;
        $project = Project::find($request->id);

        return view('project.estados_pago.generate', compact(['project','num_meses']));
    }

    function generate_store(Request $request){
        $num_meses = $request->num_meses;
        $project = Project::find($request->id);

        /*$suma = 0;
        for($i = 0; $i < $num_meses; $i++){
            $suma += $request->input('avance_programado'.$i);
        }

        if($suma != $project->costo_total)
            return Redirect::back()->withInput($request->all())->with('alert', 'La suma de los montos no coincide con el costo total! ('.$project->costo_total.')');
        */
        $inicio = Carbon::createFromformat('Y-m-d', $project->fecha_inicio);
        for($i = 0; $i < $num_meses; $i++){
            $inicio->addMonth();
            Estado_Pago::factory()->create([
                'fecha' => $inicio,
                'project_id' => $project->id,
                'avance_programado' => $request->input('avance_programado'.$i),
                'avance_actual' => 0,
                'pathfile' => '',
            ]);
        }

        return redirect()->route('project.estados_pago', ['id'=>$project->id])->with('success', 'estados de pago creados correctamente!');;
    }
    
    function index($id){
        $project = Project::find($id);
        $estados_pago = Estado_Pago::where('project_id', $project->id)->orderBy('fecha', 'asc')->get();
        $period = \Carbon\CarbonPeriod::create($project->fecha_inicio, '1 month', $project->fecha_termino);
        if(!$estados_pago->isEmpty()){
            $num_meses = count($estados_pago);
        } else {
            $num_meses = count($period) - 1;
        }
        $tipos_multa = Tipo_Multa::orderBy('porcentaje_1', 'asc')->get();
        $aux_acc = 0;
        $aux_actual_acc = 0;
        $chart_labels = [];
        $chart_data1 = [];
        $chart_data2 = [];
        $alerts = [];
        if(session()->get('success') !== null){
            $alerts['success'] = session()->get('success');
        } elseif (session()->get('error' !== null)){
            $alerts['error'] = session()->get('error');
        }
        foreach($estados_pago as $ep){
            $aux_acc += $ep->avance_programado;
            $aux_actual_acc += $ep->avance_actual;
            $ep->avance_programado_acc = $aux_acc;
            $ep->avance_actual_acc = $aux_actual_acc;
            $ep->dif = round((1 - ($ep->avance_actual / $ep->avance_programado))*100,2);
            $ep->monto_sugerido_multa = 0;
            if(isset($ep->multa_id)){
                $ep->multa = Multa::find($ep->multa_id);
                $ep->tipo_multa = Tipo_Multa::find($ep->multa->tipo_multa_id);
                $ep->monto_sugerido_multa = ($ep->tipo_multa->porcentaje_multa / 100) * $project->costo_total;
            } else {
                foreach($tipos_multa as $tm){
                    if(($tm->porcentaje_1 <= $ep->dif && $ep->dif <= $tm->porcentaje_2)){
                        $ep->monto_sugerido_multa = ($tm->porcentaje_multa / 100) * $project->costo_total;
                        $ep->tipo_multa = $tm;
                    }
                }
                $ultimo = $tipos_multa[count($tipos_multa) - 1];
                if($ep->dif > $ultimo->porcentaje_2){
                    $ep->monto_sugerido_multa = ($ultimo->porcentaje_multa / 100) * $project->costo_total;
                    $ep->tipo_multa = $ultimo;
                }
            }
            $chart_labels[] = Carbon::parse($ep->fecha)->format('Y-m');
            $chart_data1[] = $ep->avance_programado;
            $chart_data2[] = $ep->avance_actual;
        }
        return view('project.estados_pago.index', compact([
            'project', 'estados_pago', 'num_meses', 'chart_labels', 'chart_data1', 'chart_data2', 'alerts']));
    }

    function store(Request $request){

        $project = Project::find($request->id);
        $fecha = $request->fecha;
        $avance_programado = $request->avance_programado;
        $avance_actual = $request->avance_actual;
        $filePath = '';
        if(isset($request->archivo)){
            $archivo = $request->archivo;
            $filePath = "projects/" . $project->nombre . "/estados_de_pago/" . $request->archivo->getClientOriginalName();
            Storage::put($filePath, File::get($archivo));
        }

        Estado_Pago::factory()->create([
            'project_id' => $project->id,
            'multa_id' => null,
            'fecha' => $fecha,
            'avance_programado' => (int)$avance_programado,
            'avance_actual' => (int)$avance_actual,
            'pathfile' => $filePath
        ]);

        return redirect()->route('project.estados_pago', ['id'=>$project->id]);
    }

    function update(Request $request){

        $project = Project::find($request->project_id);
        $fecha = $request->fecha;
        $filePath = '';
        if(isset($request->archivo)){
            $archivo = $request->archivo;
            $filePath = "projects/" . $project->nombre . "/estados_de_pago/" . $request->archivo->getClientOriginalName();
            error_log($filePath);
            Storage::put($filePath, File::get($archivo));
        } elseif (isset($request->old_archivo)){
            $filePath = $request->old_archivo;
        }
        $ep = Estado_Pago::find($request->id);
        $ep->fecha = $fecha;
        //$ep->avance_programado = $request->avance_programado;
        $ep->avance_actual = $request->avance_actual;
        $ep->pathfile = $filePath;
        $ep->save();
        
        return redirect()->route('project.estados_pago', [
            'id'=>$project->id, 
        ])->with('success', 'Estado de pago actualizado correctamente!');
    }

    function historial($id, $estado_pago_id){
        $project = Project::find($id);
        $items_historial = EstadoPagoHistorial::where('estado_pago_id', $estado_pago_id)->orderBy('fecha', 'asc')->get();

        foreach($items_historial as $ep){
            $ep->dif = round((1 - ($ep->avance_actual / $ep->avance_programado))*100,2);
        }

        return view('project.estados_pago.historial', compact([
            'project', 'items_historial']));
    }

    function download(Request $request) {
        //$project = Project::find($request->id);

        error_log($request->pathfile);
        if(Storage::exists($request->pathfile))
            return Storage::download($request->pathfile);
        else
            return "Archivo no encontrado!";
    }
}