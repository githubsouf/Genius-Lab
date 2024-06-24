<?php

use App\Models\Activite;
use App\Models\Offre;
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
        Schema::create('offre_activites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Offre::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade');
            $table->unique(['offre_id', 'activite_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_activites');
    }
};
