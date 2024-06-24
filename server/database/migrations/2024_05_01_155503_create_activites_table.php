<?php

use App\Models\Administrateur;
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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Administrateur::class)->constrained()->onDelete('cascade');
            $table->string('titre');
            $table->string('description');
            $table->unsignedInteger('age_min'); 
            $table->unsignedInteger('age_max');
            $table->string('type_activite');//atelier,labo,...
            $table->unsignedInteger('eff_min'); 
            $table->unsignedInteger('eff_max');
            $table->string('nom');
            $table->string('categorie');
            $table->string('service');
            $table->string('photo')->nullable();
            $table->string('mode_de_realisation'); // 'presentiel' ou 'distance'
            $table->unsignedInteger('nbre_seance');
            $table->unsignedInteger('prix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
