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
        // Add times_awarded column to badges table
        Schema::table('badges', function (Blueprint $table) {
            $table->unsignedInteger('times_awarded')->default(0)->after('points_reward');
        });

        // Modify quiz_attempts table to add default value for score
        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->unsignedInteger('score')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('badges', function (Blueprint $table) {
            $table->dropColumn('times_awarded');
        });

        Schema::table('quiz_attempts', function (Blueprint $table) {
            $table->unsignedInteger('score')->change();
        });
    }
};
