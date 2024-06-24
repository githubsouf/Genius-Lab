<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationFormsTable extends Migration
{
    public function up()
    {
        Schema::create('recommendation_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('enfant_id')->constrained()->onDelete('cascade');
            $table->text('preferences'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recommendation_forms');
    }
}
