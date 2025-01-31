<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();                                     // Coluna 'id' auto-incremento e chave primária
            $table->string('title');                          // Título do livro
            $table->date('publication_date');                 // Data de publicação
            $table->unsignedBigInteger('publisher_id');       // Chave estrangeira para a tabela publishers
            $table->unsignedBigInteger('target_audience_id'); // Chave estrangeira para a tabela target_audiences
            $table->string('category');                       // Categoria do livro
            $table->timestamps();                             // Colunas 'created_at' e 'updated_at'

            // Definindo as chaves estrangeiras
            $table->foreign('publisher_id')->references('id')->on('publishers')->onDelete('cascade');
            $table->foreign('target_audience_id')->references('id')->on('target_audiences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
