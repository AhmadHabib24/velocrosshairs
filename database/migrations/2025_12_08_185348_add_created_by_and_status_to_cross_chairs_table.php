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
        Schema::table('cross_chairs', function (Blueprint $table) {
            // Add created_by column (foreign key to users table)
            $table->unsignedBigInteger('created_by')->nullable()->after('category_id');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            
            // Add status column with enum values
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cross_chairs', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['created_by']);
            
            // Drop columns
            $table->dropColumn(['created_by', 'status']);
        });
    }
};