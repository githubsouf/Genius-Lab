<?php

use App\Models\Activite;
use App\Models\Demande;
use App\Models\Enfant;
use App\Models\Modalite;
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
        Schema::create('demande_activite_enfants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Enfant::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Demande::class)->constrained()->onDelete('cascade'); 
            $table->string('modalite');
            // Ajout de la contrainte d'unicité
            $table->unique(['enfant_id', 'activite_id']);
            $table->timestamps();
        });
    }
//004823
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_activite_enfants');
    }
};
