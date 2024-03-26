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
            $table->dropColumn('address');
            $table->string('building_name')->nullable()->after('full_name');
            $table->string('area')->nullable()->after('building_name');
            $table->string('landmark')->nullable()->after('area');
            $table->string('city')->nullable()->after('landmark');
            $table->string('pincode')->nullable()->after('city');
            $table->string('alternate_contact_no')->nullable()->after('pincode');
            $table->string('aadhar_card_no')->nullable()->after('alternate_contact_no');
            $table->string('pan_card_no')->nullable()->after('aadhar_card_no');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoarding_permissions', function (Blueprint $table) {
            $table->text('address');
            $table->dropColumn('building_name');
            $table->dropColumn('area');
            $table->dropColumn('landmark');
            $table->dropColumn('city');
            $table->dropColumn('pincode');
            $table->dropColumn('alternate_contact_no');
            $table->dropColumn('aadhar_card_no');
            $table->dropColumn('pan_card_no');
        });
    }
};
