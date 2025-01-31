<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_notes', function (Blueprint $table) {
            $table->id();                             // Coluna 'id' auto-incremento e chave primária
            $table->decimal('purchase_value', 10, 2); // Valor da compra (10 dígitos, 2 casas decimais)
            $table->decimal('sale_value', 10, 2);     // Valor da venda (10 dígitos, 2 casas decimais)
            $table->date('sale_date');                // Data da venda
            $table->unsignedBigInteger('product_id'); // Chave estrangeira para a tabela products
            $table->timestamps();                     // Colunas 'created_at' e 'updated_at'

            // Definindo a chave estrangeira
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_notes');
    }
}
