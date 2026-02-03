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
        Schema::table('subscribers', function (Blueprint $table) {
            //
            $table->string('phone_number')->after('status')->nullable();
            $table->boolean('event')->after('phone_number')->default(false)->nullable();
            $table->unsignedInteger('eventId')->after('event')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscribers', function (Blueprint $table) {
            //
            $table->dropColumn(['phone_number','event','eventId']);
        });
    }
};
