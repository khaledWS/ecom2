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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('slug',300)->nullable();
            $table->string('info',300)->nullable()->comment('samll info');
            $table->text('details')->nullable();
            $table->text('description')->nullable();
            $table->boolean('in_stock')->default(false);
            $table->string('quantity')->default('0');
            $table->string('base_tax')->nullable();
            $table->string('tag')->nullable()->comment('Main Tag');
            $table->string('tags')->nullable()->comment('Other Tags');
            $table->string('Featured')->nullable()->comment('different Levels');
            $table->string('rating')->nullable();
            $table->boolean('active')->default('0');
            $table->text('history')->nullable();
            $table->text('base_price');
            $table->foreignId('discount_id')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('vendor_id');
            $table->foreignId('product_id')->nullable();
            $table->text('image')->comment('main Picture');
            $table->text('image_list')->nullable()->comment('array of other pictures of the product');
            $table->softDeletes();
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
};
