# AdSense readiness checklist (Velocrosshairs)

## Before re-applying to AdSense

1. Run `php artisan migrate` and `php artisan crosshairs:sync-indexable --limit=150`.
2. Fill **Long Description** for each category in Admin → Categories (400+ unique words per hub).
3. Manually enable **Allow Google indexing** only on crosshairs with unique intros.
4. Publish blogs regularly (target 25–40+ published guides).
5. Wait 2–4 weeks after changes; submit sitemap in Google Search Console.
6. Re-apply only when dashboard shows ~150 indexable crosshairs and duplicate intros are fixed.

## Technical commands

```bash
php artisan migrate
php artisan crosshairs:sync-indexable --limit=150
php artisan route:clear
php artisan view:clear
```

## Targets

| Metric | Target |
|--------|--------|
| Indexable crosshairs in sitemap | ≤ 150 (top performers) |
| Duplicate description openers | 0 groups with 5+ matches |
| Category hub pages | 3 with long descriptions |
| Published blogs | 25+ |
