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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name',200);
            $table->string('slug',300)->nullable();
            $table->foreignId('category_id');
            $table->text('categories');
            $table->foreignId('user_id');
            $table->text('staff');
            $table->text('description')->nullable();
            $table->boolean('active')->default(false);
            $table->text('profile')->comment('main Picture');
            $table->text('banner')->comment('banner');
            $table->boolean('status')->nullable();
            $table->string('featured')->nullable()->comment('different Levels');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
};
