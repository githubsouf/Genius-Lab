<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->unsignedBigInteger('notifiable_id'); // Ajoute la colonne notifiable_id
            $table->string('notifiable_type'); // Ajoute la colonne notifiable_type
            $table->text('data');
            $table->timestamp('read_at')->nullable(); // Utilisé pour marquer les notifications comme lues
            $table->timestamps();

            // Ajoute un index composite sur notifiable_id et notifiable_type
            $table->index(['notifiable_id', 'notifiable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
