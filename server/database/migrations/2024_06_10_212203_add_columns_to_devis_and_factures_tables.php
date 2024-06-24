<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToDevisAndFacturesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->date('date_devis')->nullable();
            $table->decimal('Total_HT', 10, 2)->nullable();
            $table->decimal('Total_TTC', 10, 2)->nullable();
            $table->decimal('TVA', 5, 2)->nullable();
            $table->string('devis_pdf')->nullable();
        });

        Schema::table('factures', function (Blueprint $table) {
            $table->date('date_facture')->nullable();
            $table->decimal('total_HT', 10, 2)->nullable();
            $table->decimal('total_TTC', 10, 2)->nullable();
            $table->decimal('TVA', 5, 2)->nullable();
            $table->string('facture_pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devis', function (Blueprint $table) {
            $table->dropColumn(['date_devis', 'Total_HT', 'Total_TTC', 'TVA', 'devis_pdf']);
        });

        Schema::table('factures', function (Blueprint $table) {
            $table->dropColumn(['date_facture', 'total_HT', 'total_TTC', 'TVA', 'facture_pdf']);
        });
    }
}
