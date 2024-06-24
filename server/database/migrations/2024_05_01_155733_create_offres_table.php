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
    Schema::create('offres', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Administrateur::class)->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->date('date_debut');
        $table->date('date_fin');
        $table->text('description');
        $table->string('photo')->nullable();
        $table->integer('remise')->default(0); // Colonne remise avec valeur par défaut de 0
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};
