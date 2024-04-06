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
        Schema::create('tipo_multas', function (Blueprint $table) {
            $table->id();
            $table->decimal('porcentaje_1',5,2);
            $table->decimal('porcentaje_2',5,2);
            $table->decimal('porcentaje_multa',5,2);
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
        Schema::dropIfExists('tipo_multas');
    }
};
