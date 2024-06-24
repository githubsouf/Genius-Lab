<?php

use App\Models\ActiviteModalite;
use App\Models\Modalite;
use App\Models\Parental;
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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Parental::class)->constrained()->onDelete('cascade');
            //$table->foreignIdFor(Modalite::class)->constrained()->onDelete('cascade'); 
            $table->integer('statut')->default(0);//il sera toujours 0 au debut et il va devenir 1 quand l''admin accepte la demande
            //trimestriel,semestriel,mensuel,annuel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
