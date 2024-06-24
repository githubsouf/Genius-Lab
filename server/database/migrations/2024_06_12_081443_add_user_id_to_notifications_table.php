<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Ajoute la colonne user_id
            $table->unsignedBigInteger('user_id')->after('id')->default(1); // Définit 1 comme valeur par défaut
            // Définit la clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Supprime la clé étrangère et la colonne
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}