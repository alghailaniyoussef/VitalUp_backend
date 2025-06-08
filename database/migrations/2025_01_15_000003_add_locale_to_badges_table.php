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
        Schema::table('badges', function (Blueprint $table) {
            $table->string('locale', 5)->default('en')->after('is_active');
            $table->index(['locale', 'type']);
            $table->index(['is_active', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropIndex(['locale', 'type']);
            $table->dropIndex(['is_active', 'locale']);
            $table->dropColumn('locale');
        });
    }
};
