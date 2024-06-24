<?php

use App\Models\Activite;
use App\Models\Modalite;
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
        Schema::create('activite_modalites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Modalite::class)->constrained()->onDelete('cascade');
            $table->unique(['modalite_id', 'activite_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_modalites');
    }
};
