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
        Schema::create('centros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->date('inicio');
            $table->date('fin');
            $table->date('encendido');
            $table->integer('avance');
            $table->decimal('latitud');
            $table->decimal('longitud');
            $table->integer('diasCultivo');
            $table->integer('anchoJaula');
            $table->integer('largoJaula');
            $table->integer('numeroJaulas');
            $table->integer('lamparasJaula');
            $table->integer('lamparasCentro');
            $table->integer('distModPon');
            $table->integer('numeroBackup');
            $table->integer('modulos');
            $table->integer('tableros');
            $table->date('proyeccionDesarme');
            $table->integer('estadoId');
            $table->integer('areaId');
            $table->integer('trabajoId');
            $table->integer('especieId');
            $table->integer('tipoLamparaId');
            $table->integer('monitoreoId');
            $table->integer('empresaId');
            $table->integer('modalidadId');
            $table->integer('tipoCentroId');
            $table->integer('alevCantidadEstanques');
            $table->integer('alevLamparasEstanque');
            $table->integer('alevTipoLamparaId');
            $table->integer('alevUbicacionLamparaId');
            $table->integer('alimCantidadEstanques');
            $table->integer('alimLamparasEstanque');
            $table->integer('alimTipoLamparaId');
            $table->integer('alimUbicacionLamparaId');
            $table->integer('modeloProductivoId');
            $table->integer('smoltCantidadEstanques');
            $table->integer('smoltLamparasEstanque');
            $table->integer('smoltTipoLamparaId');
            $table->integer('smoltUbicacionLamparaId');
            $table->integer('alevDiametro');
            $table->integer('alevDiametroString');
            $table->integer('alevProfundidad');
            $table->integer('alevProfundidadString');
            $table->integer('alevUnidadCultivoId');
            $table->decimal('alevVolumen');
            $table->integer('alimDiametro');
            $table->integer('alimDiametroString');
            $table->integer('alimProfundidad');
            $table->integer('alimProfundidadString');
            $table->integer('alimUnidadCultivoId');
            $table->decimal('alimVolumen');
            $table->integer('cultCantidadEstanques');
            $table->integer('cultDiametro');
            $table->integer('cultDiametroString');
            $table->integer('cultLamparasEstanque');
            $table->integer('cultProfundidad');
            $table->integer('cultProfundidadString');
            $table->integer('cultTipoLamparaId');
            $table->integer('cultUbicacionLamparaId');
            $table->integer('cultUnidadCultivoId');
            $table->decimal('cultVolumen');
            $table->integer('smoltDiametro');
            $table->integer('smoltDiametroString');
            $table->integer('smoltProfundidad');
            $table->integer('smoltProfundidadString');
            $table->integer('smoltUnidadCultivoId');
            $table->decimal('smoltVolumen');
            $table->integer('paisId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros');
    }
};
