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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('introduccion', 255);
            $table->string('imagen', 255);
            $table->text('body');
            $table->boolean('status')->default(0);

            //relacion con usuario

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id') //relacion
                ->references('id') //campo de referencia
                ->on('users') // tabla de referencia
                ->onDelete('set null'); //para no eliminar sua articulo si se elimina el usuario



            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id') //relacion
                ->references('id') //campo de referencia
                ->on('categories') // tabla de referencia
                ->onDelete('cascade'); //si se elimina el usuario

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
