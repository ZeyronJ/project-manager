<?php

namespace App\Console\Commands;

use App\Models\Boleta;
use App\Models\Estado_Pago;
use App\Models\Project;
use Illuminate\Console\Command;

class NotificacionesCorreo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificaciones:correo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Boleta::boletas_por_vencer_correo();
        Estado_Pago::multas_sin_cursar();
        Project::proyectos_por_vencer_correo();
    }
}
