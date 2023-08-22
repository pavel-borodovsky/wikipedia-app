<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('atoms', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->timestamps();
        });

        Schema::create('atom_article', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('atom_id');
            $table->unsignedBigInteger('article_id');
            $table->unsignedInteger('occurrences');

            $table->foreign('atom_id')->references('id')->on('atoms')->onDelete('cascade');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('atom_article', function (Blueprint $table) {
            $table->dropForeign(['atom_id']);
            $table->dropForeign(['article_id']);
        });
        Schema::dropIfExists('atom_article');
        Schema::dropIfExists('atoms');
    }
};
