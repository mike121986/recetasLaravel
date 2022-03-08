<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* vamos a crear otra tabla dentro de esta migracion, en este caso nos ahorrarmos otra migracion  */
        Schema::create('categoria_recetas',function(Blueprint $table){
            $table->id();
            $table->string('nombre');
            $table->timestamps();

        });
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('ingredientes');
            $table->text('preparacion');
            $table->string('imagen');
            $table->foreignId('user_id')->references('id')->on('users')->comment(' el usuario que crea la receta');
            $table->foreignId('categoria_id')->references('id')->on('categoria_recetas')->comment(' categoria de la receta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_receta');
        Schema::dropIfExists('recetas');
    }
};
