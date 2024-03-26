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
        Schema::table('hoarding_permission_payments', function (Blueprint $table) {
            $table->text('payment_response')->after('payment_id')->nullable();
            $table->string('transaction_id')->after('payment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoarding_permission_payments', function (Blueprint $table) {
            $table->dropColumn('transaction_id');
            $table->dropColumn('payment_response');
        });
    }
};
