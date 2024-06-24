<?php

use App\Models\Activite;
use App\Models\Langue;
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
        Schema::create('activite_langues', function (Blueprint $table) {
            $table->id();
            // on a rendu le id de l'activite unique car un activite a une seul langue
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade')->unique('activite_unique');
            $table->foreignIdFor(Langue::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_langues');
    }
};
