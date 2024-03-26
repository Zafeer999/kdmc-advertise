<?php

use App\Models\HoardingPermission;
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
        Schema::create('hoarding_permission_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HoardingPermission::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('payment_id')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedFloat('amount_payable', 8, 2);
            $table->unsignedFloat('amount_paid', 8, 2)->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoarding_permission_payments');
    }
};
