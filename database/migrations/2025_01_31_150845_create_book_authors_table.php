<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_authors', function (Blueprint $table) {
            $table->id();                            // Coluna 'id' auto-incremento e chave primária
            $table->unsignedBigInteger('book_id');   // Chave estrangeira para a tabela books
            $table->unsignedBigInteger('author_id'); // Chave estrangeira para a tabela authors
            $table->timestamps();                    // Colunas 'created_at' e 'updated_at'

            // Definindo as chaves estrangeiras
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');

            // Definindo uma chave única composta para evitar duplicações
            $table->unique(['book_id', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_authors');
    }
}
