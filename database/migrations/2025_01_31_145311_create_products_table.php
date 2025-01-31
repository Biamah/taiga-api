<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                    // Coluna 'id' auto-incremento e chave primária
            $table->unsignedBigInteger('volume_id');         // Chave estrangeira para a tabela volumes
            $table->decimal('purchase_value', 10, 2);        // Valor de compra (10 dígitos, 2 casas decimais)
            $table->decimal('sale_value', 10, 2);            // Valor de venda (10 dígitos, 2 casas decimais)
            $table->decimal('promotion', 10, 2)->nullable(); // Promoção (opcional)
            $table->boolean('sold')->default(false);         // Vendido (boolean, padrão false)
            $table->string('category');                      // Categoria
            $table->string('barcode')->unique();             // Código de barras (único)
            $table->timestamps();                            // Colunas 'created_at' e 'updated_at'

            // Definindo a chave estrangeira
            $table->foreign('volume_id')->references('id')->on('volumes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
