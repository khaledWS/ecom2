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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('slug',300)->nullable();
            $table->string('info',300)->nullable()->comment('samll info');
            $table->string('image',300)->nullable()->comment('image');
            $table->text('description')->nullable();
            $table->boolean('is_main')->default(false)->comment('if its a main or not');
            $table->foreignId('parent_category_id')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('categories');
    }
};
