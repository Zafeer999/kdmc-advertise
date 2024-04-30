<?php

use App\Models\Banner;
use App\Models\Location;
use App\Models\User;
use App\Models\Ward;
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
        Schema::create('hoarding_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('full_name');
            $table->text('address');
            $table->string('contact_no');
            $table->string('advertise_type');
            $table->foreignIdFor(Ward::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreignIdFor(Location::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('location');
            $table->date('from_date');
            $table->date('to_date');
            $table->foreignIdFor(Banner::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('banner_image');
            $table->text('advertise_detail');
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoarding_permissions');
    }
};
