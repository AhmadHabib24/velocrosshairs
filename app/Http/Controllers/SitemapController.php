<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\CrossChair;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $categories = Category::where('is_active', true)->get(['slug', 'updated_at']);
        $crosshairs = CrossChair::where('is_active', true)
            ->where('is_indexable', true)
            ->get(['slug', 'updated_at']);
        $blogs = Blog::where('status', 'published')->get(['slug', 'updated_at', 'published_at']);

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $staticPages = [
            ['path' => '/', 'freq' => 'daily', 'priority' => '1.0'],
            ['path' => '/crosshairs', 'freq' => 'daily', 'priority' => '0.9'],
            ['path' => '/blogs', 'freq' => 'daily', 'priority' => '0.9'],
            ['path' => '/about-us', 'freq' => 'monthly', 'priority' => '0.7'],
            ['path' => '/contact', 'freq' => 'monthly', 'priority' => '0.7'],
            ['path' => '/privacy-policy', 'freq' => 'yearly', 'priority' => '0.5'],
            ['path' => '/terms-and-conditions', 'freq' => 'yearly', 'priority' => '0.5'],
            ['path' => '/disclaimer', 'freq' => 'yearly', 'priority' => '0.5'],
            ['path' => '/advertisement-policy', 'freq' => 'yearly', 'priority' => '0.5'],
        ];

        foreach ($staticPages as $page) {
            $xml .= $this->urlEntry(
                'https://velocrosshairs.com' . $page['path'],
                Carbon::now(),
                $page['freq'],
                $page['priority']
            );
        }

        foreach ($categories as $category) {
            $xml .= $this->urlEntry(
                'https://velocrosshairs.com/crosshairs/category/' . $category->slug,
                $category->updated_at ?? Carbon::now(),
                'weekly',
                '0.85'
            );
        }

        foreach ($crosshairs as $crosshair) {
            $xml .= $this->urlEntry(
                'https://velocrosshairs.com/crosshairs/' . $crosshair->slug,
                $crosshair->updated_at ?? Carbon::now(),
                'monthly',
                '0.7'
            );
        }

        foreach ($blogs as $blog) {
            $lastmod = $blog->updated_at ?? $blog->published_at ?? Carbon::now();
            $xml .= $this->urlEntry(
                'https://velocrosshairs.com/blogs/' . $blog->slug,
                $lastmod,
                'weekly',
                '0.8'
            );
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function urlEntry(string $loc, $lastmod, string $changefreq, string $priority): string
    {
        $date = Carbon::parse($lastmod)->toAtomString();

        return '<url>'
            . '<loc>' . e($loc) . '</loc>'
            . '<lastmod>' . $date . '</lastmod>'
            . '<changefreq>' . $changefreq . '</changefreq>'
            . '<priority>' . $priority . '</priority>'
            . '</url>';
    }
}
