<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'contact_form', 'crosshair_submission', 'new_user'
            $table->string('title');
            $table->text('message');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Related user
            $table->foreignId('crosshair_id')->nullable()->constrained('cross_chairs')->onDelete('cascade'); // Related crosshair
            $table->foreignId('contact_id')->nullable()->constrained()->onDelete('cascade'); // Related contact
            $table->string('link')->nullable(); // Link to view details
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->json('data')->nullable(); // Additional data if needed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};