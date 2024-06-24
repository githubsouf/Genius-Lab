<?php

use App\Models\Enfant;
use App\Models\Horaire;
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
        Schema::create('dispo_enfants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Enfant::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Horaire::class)->constrained()->onDelete('cascade');
            // 0 = false = indisponible et 1 = true = disponible
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispo_enfants');
    }
};
