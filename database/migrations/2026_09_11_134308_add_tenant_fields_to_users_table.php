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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('condominium_id')->nullable()->after('id')->constrained('condominiums')->nullOnDelete();
            $table->string('role')->default('resident')->after('condominium_id');
            $table->string('tower')->nullable()->after('role');
            $table->string('apartment_number')->nullable()->after('tower');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('condominium_id');
            $table->dropColumn(['role', 'tower', 'apartment_number']);
        });
    }
};
