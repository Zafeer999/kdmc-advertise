<?php

use App\Models\Banner;
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
            $table->dropColumn('pan_card_no');
            $table->dropConstrainedForeignIdFor(Banner::class);

            $table->unsignedInteger('days')->after('to_date');
            $table->unsignedInteger('length')->after('days');
            $table->unsignedInteger('width')->after('length');
            $table->unsignedDouble('price')->after('width');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hoarding_permissions', function (Blueprint $table) {
            $table->string('pan_card_no', 50)->after('aadhar_card_no')->nullable();
            $table->foreignIdFor(Banner::class)->after('to_date')->constrained()->nullable();

            $table->dropColumn('days');
            $table->dropColumn('length');
            $table->dropColumn('width');
            $table->dropColumn('price');
        });
    }
};
