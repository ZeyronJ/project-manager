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
        Schema::create('boletas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('numero');
            $table->string('glosa');
            $table->string('tipo');
            $table->date('fecha_inicio')->default(Carbon\Carbon::now());
            $table->date('fecha_termino')->default(Carbon\Carbon::now());
            $table->integer('monto');
            $table->integer('estado')->default(0);
            $table->string('pathfile');
            $table->timestamps();
            
            $table->foreign('project_id')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletas');
    }
};
