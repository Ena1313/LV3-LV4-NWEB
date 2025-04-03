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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // voditelj projekta
            $table->string('naziv');
            $table->text('opis');
            $table->decimal('cijena', 10, 2);
            $table->text('obavljeni_poslovi')->nullable();
            $table->date('datum_pocetka');
            $table->date('datum_zavrsetka');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
