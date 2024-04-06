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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nombre');
            $table->integer('costo_total')->default(0);
            $table->date('fecha_inicio')->default(Carbon\Carbon::now());
            $table->date('fecha_termino')->default(Carbon\Carbon::now());
            $table->string('decreto_adjudicacion')->default('');
            $table->string('decreto_aprobacion')->default('');
            $table->string('empresa_constructora')->default('');
            $table->string('empresa_contratista')->default('');
            $table->integer('plazo_de_ejecucion')->default(0);
            $table->integer('modificacion')->default(0);
            $table->string('estado')->default('En curso');
            $table->string('pathfile');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
