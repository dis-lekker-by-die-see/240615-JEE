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
        Schema::table('riders', function (Blueprint $table) {
            $table->boolean('is_approved_by_club')->default(false)->after('club_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riders', function (Blueprint $table) {
            $table->dropColumn('is_approved_by_club');
        });
    }
};

// php artisan migrate --path=/database/migrations/2024_07_04_073137_add_is_approved_to_riders_table.php
