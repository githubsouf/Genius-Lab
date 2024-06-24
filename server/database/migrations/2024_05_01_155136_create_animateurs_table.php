<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animateurs', function (Blueprint $table) {
            $table->id();
            //si une ligne dans la table parente(User) est supprime toutes les lignes associées dans la table enfant(Animateur) seront également supprimées automatiquement 
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('country');
            $table->string('city');
            $table->string('postal');
            $table->string('address');
            $table->string('province');
            $table->string('photo')->nullable();
            $table->string('telephone');
            $table->date('date_naissance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animateurs');
    }
};
