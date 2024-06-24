<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiviteIdToDevisTable extends Migration
{
    public function up()
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->unsignedBigInteger('activite_id')->nullable();
            $table->foreign('activite_id')->references('id')->on('activites')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->dropForeign(['activite_id']);
            $table->dropColumn('activite_id');
        });
    }
}
