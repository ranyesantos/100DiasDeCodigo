<?php

declare(strict_types=1);

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
        Schema::table('socialite_users', function (Blueprint $table): void {
            $table->string('username')->nullable()->after('provider_id');
            $table->string('email')->nullable()->after('provider_id');
            $table->string('display_name')->nullable()->after('provider_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('socialite_users', function (Blueprint $table): void {
            $table->dropColumn('username');
            $table->dropColumn('email');
            $table->dropColumn('display_name');
        });
    }
};
