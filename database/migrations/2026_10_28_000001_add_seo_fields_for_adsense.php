<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cross_chairs', function (Blueprint $table) {
            if (! Schema::hasColumn('cross_chairs', 'is_indexable')) {
                $table->boolean('is_indexable')->default(true)->after('is_active');
                $table->index('is_indexable');
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            if (! Schema::hasColumn('categories', 'long_description')) {
                $table->longText('long_description')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cross_chairs', function (Blueprint $table) {
            if (Schema::hasColumn('cross_chairs', 'is_indexable')) {
                $table->dropIndex(['is_indexable']);
                $table->dropColumn('is_indexable');
            }
        });

        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'long_description')) {
                $table->dropColumn('long_description');
            }
        });
    }
};
