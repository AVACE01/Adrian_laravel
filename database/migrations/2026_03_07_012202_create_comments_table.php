<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->string('description',255);

            $table->tinyInteger('value');

            //relaciones

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id') //relacion
                ->references('id') //campo de referencia
                ->on('users') // tabla de referencia
                ->onDelete('cascade') //si se elimina el usuario
                ->onUpdate('cascade'); //si se actualiza el usuario

            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id') //relacion
                ->references('id') //campo de referencia
                ->on('articles') // tabla de referencia
                ->onDelete('cascade'); //si se elimina el usuario

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
