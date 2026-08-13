<?php

namespace App\Http\Controllers;

use App\Models\CrossChair;
use App\Models\Category;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)->get();
        $crosshairs = CrossChair::where('is_active', true)->get();

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Home page
        $sitemap .= '<url>';
        $sitemap .= '<loc>https://velocrosshairs.com/</loc>';
        $sitemap .= '<changefreq>daily</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';

        // Static pages
        $pages = [
            ['url' => '/crosshairs', 'freq' => 'daily', 'priority' => '0.9'],
            ['url' => '/about-us', 'freq' => 'monthly', 'priority' => '0.7'],
            ['url' => '/contact', 'freq' => 'monthly', 'priority' => '0.7'],
            ['url' => '/privacy-policy', 'freq' => 'yearly', 'priority' => '0.5'],
            ['url' => '/login', 'freq' => 'monthly', 'priority' => '0.6'],
            ['url' => '/register', 'freq' => 'monthly', 'priority' => '0.6'],
        ];

        foreach ($pages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>https://velocrosshairs.com' . $page['url'] . '</loc>';
            $sitemap .= '<changefreq>' . $page['freq'] . '</changefreq>';
            $sitemap .= '<priority>' . $page['priority'] . '</priority>';
            $sitemap .= '</url>';
        }

        // Categories
        foreach ($categories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>https://velocrosshairs.com/crosshairs?category=' . $category->slug . '</loc>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }

        // Individual crosshairs (if you have detail pages)
        foreach ($crosshairs as $crosshair) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>https://velocrosshairs.com/crosshairs/' . $crosshair->slug . '</loc>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }
}