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
            $table->unsignedTinyInteger('payment_status')->after('advertise_detail')->default(0)->comment('0 = unpaid, 1 = paid, 2 = cancelled');
        });

        Schema::table('location_booked_dates', function (Blueprint $table) {
            $table->unsignedTinyInteger('payment_status')->after('date')->default(0)->comment('0 = unpaid, 1 = paid, 2 = cancelled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoarding_permissions', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });

        Schema::table('location_booked_dates', function (Blueprint $table) {
            $table->dropColumn('payment_status');
        });
    }
};
