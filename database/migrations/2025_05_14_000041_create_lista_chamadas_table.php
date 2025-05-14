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
        Schema::create('lista_chamadas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_paciente');
            $table->date('dt_nascimento');
            $table->integer('id_medico');
            $table->integer('id_status');
            $table->string('sn_mostra_painel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_chamadas');
    }
};
