<?php

use App\Models\Animateur;
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
        Schema::create('langue_animateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Animateur::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Langue::class)->constrained()->onDelete('cascade');
            $table->string('proficiency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('langue_animateurs');
    }
};
