<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100); // VARCHAR 100
            $table->text('description'); // TEXT
            $table->decimal('price', 8, 2); // DECIMAL 8,2
            $table->enum('visible', ['published', 'unpublished'])->default('unpublished'); // ENUM "unpublished" par défaut
            $table->enum('status', ['sale', 'standard'])->default('standard'); // ENUM "standard" par défaut
            $table->string('reference', 16); // VARCHAR 16
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
        Schema::dropIfExists('products');
    }
}
