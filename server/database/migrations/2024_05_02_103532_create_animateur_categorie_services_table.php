<?php

use App\Models\Animateur;
use App\Models\Categorie;
use App\Models\Service;
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
        Schema::create('animateur_categorie_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animateur::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Categorie::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Service::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animateur_categorie_services');
    }
};
