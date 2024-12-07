<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id(); // ID del pedido
            $table->unsignedBigInteger('ID_usuario'); // Relación con el usuario
            $table->date('fecha_entrega'); // Fecha de entrega
            $table->timestamps(); // Agrega las columnas created_at y updated_at
    
            // Relación con la tabla usuarios
            $table->foreign('ID_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
