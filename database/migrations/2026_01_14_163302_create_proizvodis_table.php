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
        Schema::disableForeignKeyConstraints();

        Schema::create('proizvodis', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->text('opis');
            $table->integer('cena');
            $table->integer('kolicina_na_stanju');
            $table->foreignId('kategorija_id')->constrained('kategorijes');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proizvodis');
    }
};
