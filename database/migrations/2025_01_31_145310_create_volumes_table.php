<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volumes', function (Blueprint $table) {
            $table->id();                            // Coluna 'id' auto-incremento e chave primária
            $table->string('title');                 // Título do volume
            $table->integer('number');               // Número do volume (inteiro)
            $table->string('edition');               // Edição do volume
            $table->string('image')->nullable();     // URL da imagem (opcional)
            $table->unsignedBigInteger('author_id'); // Chave estrangeira para a tabela authors
            $table->unsignedBigInteger('book_id');   // Chave estrangeira para a tabela books
            $table->timestamps();                    // Colunas 'created_at' e 'updated_at'

            // Definindo as chaves estrangeiras
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volumes');
    }
}
