<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug'); //url amigavel
            $table->string('foto')->nullable();
            $table->text('descricao')->nullable();
            $table->text('ingredientes');
            $table->text('modoPreparo');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('idid')->nullable();
            $table->timestamps();

            // Relacionamento 
            $table->foreign('author')->references('id')->on('users')->onDelete('CASCADE');
            // Auto relacionamento 
            $table->foreign('idid')->references('id')->on('receitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receitas');
    }
}
