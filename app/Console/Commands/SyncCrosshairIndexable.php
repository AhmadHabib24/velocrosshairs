<?php

namespace App\Console\Commands;

use App\Models\CrossChair;
use Illuminate\Console\Command;

class SyncCrosshairIndexable extends Command
{
    protected $signature = 'crosshairs:sync-indexable {--limit=150 : Max indexable crosshairs after sync}';

    protected $description = 'Keep only top crosshairs indexable for search engines';

    public function handle(): int
    {
        $limit = max(1, (int) $this->option('limit'));

        CrossChair::query()->where('is_active', true)->update(['is_indexable' => false]);

        $topIds = CrossChair::query()
            ->where('is_active', true)
            ->orderByRaw('(views * 2 + copies * 3) DESC')
            ->limit($limit)
            ->pluck('id');

        CrossChair::query()
            ->whereIn('id', $topIds)
            ->update(['is_indexable' => true]);

        $indexed = CrossChair::where('is_active', true)->where('is_indexable', true)->count();
        $total = CrossChair::where('is_active', true)->count();

        $this->info("Indexable crosshairs: {$indexed} / {$total}");

        return self::SUCCESS;
    }
}
