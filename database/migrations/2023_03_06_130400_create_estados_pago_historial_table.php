<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_pago_historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estado_pago_id');
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('multa_id')->nullable();
            $table->date('fecha')->default(Carbon\Carbon::now());
            $table->integer('avance_programado')->default(0);
            $table->integer('avance_actual')->default(0);
            $table->integer('porcentaje_diferencia')->default(0);
            $table->string('pathfile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_pago_historial');
    }
};
