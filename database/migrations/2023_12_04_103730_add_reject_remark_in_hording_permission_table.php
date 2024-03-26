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
        Schema::table('hoarding_permissions', function (Blueprint $table) {
            $table->string('reject_remark')->nullable()->after('status_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoarding_permissions', function (Blueprint $table) {
            $table->dropColumn('reject_remark');
        });
    }
};
