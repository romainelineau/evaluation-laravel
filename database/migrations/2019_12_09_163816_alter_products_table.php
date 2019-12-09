<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->nullable(); // Un produit peut ne pas avoir de catégorie
            $table->unsignedInteger('size_id')->nullable(); // Un produit peut ne pas avoir de taille
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL'); // Si la catégorie est supprimée, on met NULL à la place
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('SET NULL'); // Si la taille est supprimée, on met NULL à la place
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_size_id_foreign');
            $table->dropColumn('category_id');
            $table->dropColumn('size_id');
        });
    }
}
