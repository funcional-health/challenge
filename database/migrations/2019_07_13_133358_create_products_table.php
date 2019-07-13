<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('industry_id');
            $table->string('name')->index();
            $table->unsignedInteger('price')->default(0); // price stored as integer to avoid round errors
            $table->unsignedInteger('stock')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('industry_id')
                ->references('id')
                ->on('industries');
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
