<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receita');
            $table->text('comentario');
            $table->unsignedBigInteger('coment')->nullable();
            $table->unsignedBigInteger('author');

            // Relacionamento 
            $table->foreign('receita')->references('id')->on('receitas')->onDelete('CASCADE');
            $table->foreign('author')->references('id')->on('users')->onDelete('CASCADE');
            // Auto relacionamento 
            $table->foreign('coment')->references('id')->on('comentarios')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
}
