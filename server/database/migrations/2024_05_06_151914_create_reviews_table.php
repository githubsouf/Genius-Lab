<?php

use App\Models\Activite;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Activite::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Parental::class)->constrained()->onDelete('cascade');
            $table->string('description',1000);
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            // Adding unique constraint on activite_id and parental_id
            $table->unique(['activite_id', 'parental_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
