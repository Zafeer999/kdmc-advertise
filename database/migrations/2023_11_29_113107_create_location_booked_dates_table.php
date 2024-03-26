<?php

use App\Models\HoardingPermission;
use App\Models\Location;
use App\Models\User;
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
        Schema::create('location_booked_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Location::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(HoardingPermission::class)->constrained();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_booked_dates');
    }
};
