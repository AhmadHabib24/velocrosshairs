<?php

namespace App\Support;

use App\Models\CrossChair;

class CrosshairDescriptionGuard
{
    public static function introFingerprint(?string $description): string
    {
        $normalized = strtolower(trim(preg_replace('/\s+/', ' ', (string) $description)));

        return substr($normalized, 0, 50);
    }

    public static function duplicateCount(string $fingerprint, ?int $exceptId = null): int
    {
        if (strlen($fingerprint) < 20) {
            return 0;
        }

        $query = CrossChair::query()
            ->where('is_active', true)
            ->whereNotNull('description')
            ->whereRaw('LOWER(LEFT(TRIM(description), 50)) = ?', [$fingerprint]);

        if ($exceptId) {
            $query->where('id', '!=', $exceptId);
        }

        return $query->count();
    }

    public static function isDuplicateIntro(?string $description, ?int $exceptId = null): bool
    {
        $fingerprint = self::introFingerprint($description);

        return self::duplicateCount($fingerprint, $exceptId) > 0;
    }
}
