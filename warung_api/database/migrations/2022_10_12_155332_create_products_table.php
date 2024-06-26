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
        Schema::create('warungapi_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('categoryId')->nullable();
            $table->integer('price');
            $table->integer('quantity')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('categoryId')->references('id')->on('warungapi_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('warungapi_products');
    }
};
