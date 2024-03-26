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
            $table->integer('status')->nullable()->default('0')->comment('0 = pending 1 = Approve 2 = Reject')->after('advertise_detail');
            $table->integer('status_by')->nullable()->after('status');
            $table->timestamp('status_date')->nullable()->after('status_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoarding_permissions', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('status_by');
            $table->dropColumn('status_date');
        });
    }
};
