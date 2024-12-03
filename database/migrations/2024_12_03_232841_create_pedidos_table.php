<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_pedidos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->string('telefono');
            $table->string('producto');
            $table->string('sabor')->nullable();
            $table->string('tamano_cantidad');
            $table->string('relleno')->nullable();
            $table->enum('status', ['pendiente', 'en_proceso', 'finalizado']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
