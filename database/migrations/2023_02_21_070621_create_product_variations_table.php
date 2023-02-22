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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attribute_id')->constrained() ;
            $table->foreignId('product_id')->constrained() ;

            $table->string('value') ;

            $table->unsignedInteger('price')->default(0) ;
            $table->unsignedInteger('quantity')->default(0) ;

            $table->string('sku')->nullable();

            $table->unsignedInteger('sale_price')->nullable();

            $table->timestamp('date_on_sale_from')->nullable();
            $table->timestamp('date_on_sale_to')->nullable();

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
        Schema::dropIfExists('product_variations');
    }
};
