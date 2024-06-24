<?php

use App\Models\Activite;
use App\Models\Animateur;
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
        Schema::create('animers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animateur::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Horaire::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
//155503
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animers');
    }
};
