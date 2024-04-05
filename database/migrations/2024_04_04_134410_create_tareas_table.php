<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained();
            $table->foreignId('tecnico_id')->constrained();
            $table->string('folio')->unique();
            $table->string('direccion');
            $table->unsignedBigInteger('especie_id')->nullable();
            $table->foreign('especie_id')->references('id')->on('especies');
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->integer('cant_servicios');
            $table->decimal('dap', 8, 2); // 8 digitos en total, 2 decimales
            $table->integer('plazos');
            $table->string('est_fitosanitario')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->enum('estados', ['CREADA', 'EN PROCESO', 'RECHAZADA', 'REALIZADA'])->default('CREADA');
            $table->enum('estpago', ['POR PAGAR', 'PAGADO'])->default('POR PAGAR');
            $table->longText('observacion')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};