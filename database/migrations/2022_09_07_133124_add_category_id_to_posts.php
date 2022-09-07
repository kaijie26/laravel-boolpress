<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Aggiungo la colonna category_id
            $table->unsignedBigInteger('category_id')->nullable();

            // Aggiungo la relazione
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Recido la relazione
            $table->dropForeign('posts_category_id_foreign');

            // Cancello la colonna
            $table->dropColumn('category_id');
        });
    }
}
