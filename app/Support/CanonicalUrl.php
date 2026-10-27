<?php

namespace App\Support;

use Illuminate\Http\Request;

class CanonicalUrl
{
    public static function forRequest(?Request $request = null): string
    {
        $request = $request ?? request();
        $base = rtrim(config('app.url', 'https://velocrosshairs.com'), '/');

        if ($request->is('crosshairs/category/*')) {
            return $base . '/crosshairs/category/' . $request->route('slug');
        }

        if ($request->is('crosshairs') && ! $request->route('slug')) {
            $page = (int) $request->query('page', 1);

            if ($page > 1) {
                return $base . '/crosshairs?page=' . $page;
            }

            return $base . '/crosshairs';
        }

        if ($request->is('blogs') && ! $request->route('slug')) {
            $page = (int) $request->query('page', 1);

            if ($page > 1) {
                return $base . '/blogs?page=' . $page;
            }

            return $base . '/blogs';
        }

        if ($request->is('/') && $request->hasAny(['category', 'sort', 'search'])) {
            return $base . '/';
        }

        $path = trim($request->path(), '/');

        if ($path === '') {
            return $base . '/';
        }

        return $base . '/' . $path;
    }
}
