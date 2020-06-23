<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColegasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seguidor');
            $table->unsignedBigInteger('seguido');

            // Relacionamento 
            $table->foreign('seguidor')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('seguido')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colegas');
    }
}
