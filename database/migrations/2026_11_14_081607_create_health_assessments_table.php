<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_assessments', function (Blueprint $table) {
            $table->id();

            // Raw answers
            $table->unsignedTinyInteger('sleep_hours');          // 5,6,7,9
            $table->string('exercise');                         // yes, partial, no
            $table->string('bone_discomfort');                  // none, mild, moderate
            $table->string('mood');                             // excellent, good, low, stressed
            $table->string('isolation');                        // low, medium, high
            $table->string('energy');                           // high, normal, low

            // Calculated results
            $table->unsignedTinyInteger('readiness_score');     // 0-100
            $table->string('overall_status');                   // All Readings Normal / Minor Attention Needed / Action Recommended
            $table->string('overall_sub');

            // Body systems
            $table->string('brain_status')->default('Normal');
            $table->string('brain_desc');
            $table->string('heart_status')->default('Normal');
            $table->string('heart_desc');
            $table->string('bones_status')->default('Normal');
            $table->string('bones_desc');
            $table->string('eyes_status')->default('Normal');
            $table->string('eyes_desc');
            $table->string('immune_status')->default('Normal');
            $table->string('immune_desc');

            // Vitals (simulated based on answers)
            $table->unsignedSmallInteger('heart_rate');
            $table->string('blood_pressure');
            $table->decimal('temperature', 3, 1);
            $table->unsignedSmallInteger('blood_glucose');
            $table->decimal('sleep_hours_display', 3, 1);

            // Action guidance
            $table->text('main_alert')->nullable();
            $table->json('guidance_items');                     // array of strings

            // Hazards levels (dynamic)
            $table->string('hazard_radiation')->default('Medium');
            $table->unsignedTinyInteger('hazard_radiation_pct')->default(58);
            $table->string('hazard_isolation')->default('Low');
            $table->unsignedTinyInteger('hazard_isolation_pct')->default(28);
            $table->string('hazard_distance')->default('Low');
            $table->unsignedTinyInteger('hazard_distance_pct')->default(32);
            $table->string('hazard_gravity')->default('Medium');
            $table->unsignedTinyInteger('hazard_gravity_pct')->default(62);
            $table->string('hazard_closed')->default('Low');
            $table->unsignedTinyInteger('hazard_closed_pct')->default(25);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_assessments');
    }
};
