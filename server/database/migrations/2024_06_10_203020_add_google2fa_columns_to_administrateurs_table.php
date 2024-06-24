<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogle2faColumnsToAdministrateursTable extends Migration
{
    public function up()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->string('google2fa_secret')->nullable();
            $table->boolean('google2fa_enabled')->default(false);
        });
    }

    public function down()
    {
        Schema::table('administrateurs', function (Blueprint $table) {
            $table->dropColumn('google2fa_secret');
            $table->dropColumn('google2fa_enabled');
        });
    }
}


