<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //adiciona a coluna 'situation_id' na tabela 'calls'
        Schema::table('calls', function (Blueprint $table) {
            $table->foreignId('situation_id')->constrained('situations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropForeign(['situation_id']);
            $table->dropColumn('situation_id');
        });
    }
};
