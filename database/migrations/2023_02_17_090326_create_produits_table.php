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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->String('description');
            $table->Integer('prix');
            $table->unsignedBigInteger('categorie_id'); 
            $table->timestamps();

            $table->foreign('categorie_id') 
                ->references('id')
                ->on('categories')
                ->onDelete('cascade'); // option pour supprimer les produits liés à une catégorie supprimée
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
};
