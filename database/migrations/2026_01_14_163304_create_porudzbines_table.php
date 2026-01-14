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

        Schema::create('porudzbines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kupac_id')->constrained('kupcis');
            $table->date('datum_porudzbine');
            $table->text('status');
            $table->integer('ukupan_iznos');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porudzbines');
    }
};
