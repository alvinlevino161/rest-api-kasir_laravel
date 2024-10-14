<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('product_id');
        $table->integer('quantity');
        $table->integer('total_price');
        $table->timestamps();

        $table->foreign('product_id')->references('id')->on('products');
    });
}

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};