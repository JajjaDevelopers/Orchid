<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY bio LONGTEXT NULL");
        DB::statement("ALTER TABLE users MODIFY profile_picture VARCHAR(255) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY bio LONGTEXT NOT NULL");
        DB::statement("ALTER TABLE users MODIFY profile_picture VARCHAR(255) NOT NULL");
    }
};