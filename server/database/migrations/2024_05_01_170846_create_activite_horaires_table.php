<?php

use App\Models\Activite;
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
        Schema::create('activite_horaires', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Horaire::class)->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('Num_seance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_horaires');
    }
};
