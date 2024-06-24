<?php

use App\Models\Animateur;
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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animateur::class)->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('company');
            $table->string('country');
            $table->string('city');
            //si l'animateur is currently working in this role 
            $table->boolean('statut')->default(false);
            $table->date('start_date');
            //si le statut est true on doit remplir end_date par null et ne pas donner a l'animateur la possibilite d'ecrire dans ce champ
            $table->date('end_date');
            $table->string('description',1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
