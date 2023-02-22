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
        Schema::create('attribute_category', function (Blueprint $table) {

            $table->foreignId('attribute_id')->constrained() ;
            $table->foreignId('category_id')->constrained() ;

            $table->boolean('is_filter')->default(0) ;
            $table->boolean('is_variation')->default(0) ;

            $table->primary(['attribute_id' , 'category_id']) ;

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
        Schema::dropIfExists('attribute_category');
    }
};
