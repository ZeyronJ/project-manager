<?php

use App\Http\Controllers\BoletaController;
use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\EstadoPagoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailPMController;
use App\Http\Controllers\ModificacionController;
use App\Http\Controllers\MultaController;
use App\Http\Controllers\ProjectController;
use Database\Factories\MultaFactory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',    
])->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');

    Route::middleware(['role:admin|inspector de obra|lector'])->prefix('project_manager')->group(function() {

        Route::get('/crear_proyecto', [ProjectController::class,'add_project'])->name('project.add');
        Route::post('/crear', [ProjectController::class,'adding_project'])->name('project.adding');

        Route::prefix('/{id}')->group(function() {

            #Project controller

            
            Route::get('/info', [ProjectController::class,'show_project'])->name('project.show');
            
            Route::get('/editar_proyecto', [ProjectController::class,'edit_project'])->name('project.edit');
            Route::put('/editar', [ProjectController::class,'editting_project'])->name('project.editting');
            Route::get('/activacion', [ProjectController::class,'switch_project'])->name('project.switch');
            Route::get('/delete', [ProjectController::class,'delete_project'])->name('project.delete');

            Route::prefix('/modificaciones')->group(function() {
                Route::get('/mostrar_modificaciones', [ModificacionController::class,'show_modificaciones'])->name('project.modificacion.index');
                Route::get('/crear_modificacion', [ModificacionController::class,'modificar_proyecto'])->name('project.modificacion.create');
                Route::post('/solicitar_modificacion', [ModificacionController::class,'solicitar_modificacion'])->name('project.modificacion.request');
                Route::get('/aprobar_modificacion', [ModificacionController::class,'aprobar_modificacion'])->name('project.modificacion.approve');

            });

            Route::prefix('/directorio')->group(function() {
                Route::get('/{dirname}', [DirectorioController::class,'index'])->name('project.home');
                Route::post('/store', [DirectorioController::class,'store'])->name('project.directorio.store');
                Route::get('{dirname}/{name}/delete', [DirectorioController::class,'delete'])->name('project.directorio.delete');
                Route::get('/{name}/download', [DirectorioController::class,'download'])->name('project.directorio.download');

                Route::post('/new_folder', [DirectorioController::class,'create_folder'])->name('project.directorio.create_folder');

            });
            
            #Estado Pago controller 
            Route::prefix('/estados_pago')->group(function() {
                Route::get('/', [EstadoPagoController::class,'index'])->name('project.estados_pago');
                Route::post('/', [EstadoPagoController::class,'store'])->name('project.estados_pago.store');
                
                Route::get('/generate', [EstadoPagoController::class,'generate'])->name('project.estados_pago.generate');
                Route::post('/regenerate', [EstadoPagoController::class,'regenerate'])->name('project.estados_pago.regenerate');
                Route::post('/generate', [EstadoPagoController::class,'generate_store'])->name('project.estados_pago.generate_store');
                Route::post('/edit', [EstadoPagoController::class,'update'])->name('project.estados_pago.update');
                Route::post('/get', [EstadoPagoController::class,'download'])->name('project.estados_pago.download');
                Route::get('/{estado_pago_id}/historial', [EstadoPagoController::class,'historial'])->name('project.estados_pago.historial');
                
                Route::get('/multa', [MultaController::class,'index'])->name('project.multas');
                Route::post('/multa', [MultaController::class,'store'])->name('project.multas.store');
                Route::post('/multa/delete', [MultaController::class,'delete'])->name('project.multas.delete');
                Route::post('/multa/{multa_id}', [MultaController::class,'update'])->name('project.multas.update');
            });

            #Boletas controller 
            Route::prefix('/boletas')->group(function() {
                Route::get('/', [BoletaController::class,'index'])->name('project.boletas');
                Route::post('/', [BoletaController::class,'store'])->name('project.boletas.store');
                Route::delete('/{boleta_id}', [BoletaController::class,'destroy'])->name('project.boletas.destroy');
                Route::patch("/{boleta_id}", [BoletaController::class, 'update'])->name('project.boletas.update');
                
                Route::post("/{boleta_id}/approve", [BoletaController::class, 'approve'])->name('project.boletas.approve');
                Route::post("/{boleta_id}/disapprove", [BoletaController::class, 'disapprove'])->name('project.boletas.disapprove');

                Route::post('/download', [EstadoPagoController::class,'download'])->name('project.boletas.download');
            });
        });
    });

    Route::get('send-mail', [MailPMController::class, 'index'])->name('email');
    Route::post('send-mail', [MailPMController::class, 'send'])->name('email.send');
});

