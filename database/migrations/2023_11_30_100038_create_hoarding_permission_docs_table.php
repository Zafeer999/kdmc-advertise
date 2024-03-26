<?php

use App\Models\Document;
use App\Models\HoardingPermission;
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
        Schema::create('hoarding_permission_docs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HoardingPermission::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Document::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoarding_permission_docs');
    }
};
