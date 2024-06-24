<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailEnfantTable extends Migration
{
    public function up()
    {
        Schema::create('detail_enfant', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enfant_id');
            $table->integer('age');
            $table->string('sex');
            $table->string('domaine_prefere');
            $table->string('matiere_prefere');
            $table->timestamps();

            $table->foreign('enfant_id')->references('id')->on('enfants')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_enfant');
    }
}
