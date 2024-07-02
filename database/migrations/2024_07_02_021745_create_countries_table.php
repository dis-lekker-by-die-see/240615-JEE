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
        Schema::create('countries', function (Blueprint $table) {
            $table->id('country_id');
            $table->string('country_name')->unique();
            $table->string('country_native_name');
            $table->string('country_code', 3)->unique(); // ISO 3166-1 alpha-3
            $table->string('country_emoji');
            $table->string('country_flag_1x1');
            $table->string('country_flag_4x3');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
