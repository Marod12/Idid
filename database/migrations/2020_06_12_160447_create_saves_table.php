<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receita');
            $table->unsignedBigInteger('author');
            
            // Relacionamento 
            $table->foreign('receita')->references('id')->on('receitas')->onDelete('CASCADE'); 
            $table->foreign('author')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saves');
    }
}
