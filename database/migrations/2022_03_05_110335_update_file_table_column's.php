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
        Schema::table('files', function (Blueprint $table) {
            $table->string('original_name',200)->nullable()->comment('Og name of file')->after('name');
            $table->string('disk')->after('usage');
            $table->renameColumn('path', 'file_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn('original_name');
            $table->dropColumn('disk');
            $table->renameColumn('file_name', 'path');
        });
    }
};
