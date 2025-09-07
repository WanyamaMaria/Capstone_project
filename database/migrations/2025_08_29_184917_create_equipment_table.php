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
        Schema::create('equipment', function (Blueprint $table) {
            $table->string('equipmentId')->primary(); // Custom primary key
            $table->foreignId('facility_id')->constrained()->onDelete('cascade'); // Facility relationship
            $table->string('name'); // Equipment name
            $table->text('description')->nullable(); // Overview
            $table->string('capabilities')->nullable(); // Functional capabilities
            $table->string('inventoryCode')->unique(); // Tracking code
            $table->string('usageDomain')->nullable(); // Electronics, Mechanical, IoT, etc.
            $table->string('supportPhase')->nullable(); // Training, Testing, etc.
            $table->timestamps(); // created_at and updated_at
            $table->softDeletes(); // deleted_at for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
