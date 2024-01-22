<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustmoProductsTable extends Migration
{
    public function up()
    {
        Schema::create('custmo_products', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->integer('pages');
            $table->string('path');
            $table->timestamps(); // Esto agrega automáticamente las columnas created_at y updated_at
        });

        // Tabla pivot para la relación muchos a muchos con la tabla 'orders'
        Schema::create('custmo_product_order', function (Blueprint $table) {
            $table->foreignId('custmo_product_id')->constrained();
            $table->foreignId('order_id')->constrained();
            $table->primary(['custmo_product_id', 'order_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('custmo_products');
        Schema::dropIfExists('custmo_product_order');
    }
}

