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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('empresa_user', function (Blueprint $table){
            $table->foreignId('empresa_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->primary(['empresa_id', 'user_id']);
        });

        Schema::create('empresa_tecnico', function (Blueprint $table){
            $table->foreignId('empresa_id')->constrained();
            $table->foreignId('tecnico_id')->constrained();
            $table->primary(['empresa_id', 'tecnico_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresa_user');
        Schema::dropIfExists('empresa_tecnico');
        Schema::dropIfExists('empresas');
    }
};
