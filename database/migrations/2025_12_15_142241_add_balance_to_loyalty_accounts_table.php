<?php

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
    Schema::table('loyalty_accounts', function (Blueprint $table) {
        $table->integer('balance')->default(0); // add balance
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('loyalty_accounts', function (Blueprint $table) {
        $table->dropColumn('balance')->default(0); // add balance
    });
    }
};
