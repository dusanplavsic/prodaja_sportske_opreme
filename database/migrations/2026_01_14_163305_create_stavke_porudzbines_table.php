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

        Schema::create('stavke_porudzbines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('porudzbina_id')->constrained('porudzbines');
            $table->foreignId('proizvod_id')->constrained('proizvodis');
            $table->integer('kolicina');
            $table->integer('cena_po_komadu');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stavke_porudzbines');
    }
};
