<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            // Client details
            $table->string('client_name');
            $table->string('client_photo')->nullable(); 
            $table->string('event_type')->nullable(); // Wedding, Corporate, Conference
            // Testimonial content
            $table->text('message');
            // Optional rating (1–5)
            $table->unsignedTinyInteger('rating')->nullable();
            // Control visibility
            $table->boolean('is_active')->default(true);
            // Optional ordering
            $table->unsignedInteger('display_order')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};