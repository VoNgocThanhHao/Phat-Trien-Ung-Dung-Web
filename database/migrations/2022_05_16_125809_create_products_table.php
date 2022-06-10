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
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->unsignedFloat('price',20,2);
            $table->unsignedFloat('discount')->nullable();
            $table->string('image')->nullable();
            $table->string('images_list')->nullable();
            $table->unsignedBigInteger('view')->nullable();
            $table->tinyInteger('status');
            $table->string('chip')->nullable();
            $table->string('ram')->nullable();
            $table->timestamps();

            $table->foreignId('brand_id')->constrained('brands');
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
