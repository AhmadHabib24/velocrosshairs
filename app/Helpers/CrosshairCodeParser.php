<?php

namespace App\Helpers;

class CrosshairCodeParser
{
    /**
     * Parse Valorant crosshair code
     */
    public static function parseCrosshairCode($code)
    {
        $params = [];
        $parts = explode(';', trim($code, ';'));

        for ($i = 0; $i < count($parts) - 1; $i++) {
            $key = $parts[$i];
            $value = $parts[$i + 1] ?? null;
            if (!is_numeric($key) && $value !== null) {
                $params[$key] = $value;
            }
        }

        return $params;
    }

    /**
     * Resolve crosshair color (preset or RGB)
     */
    private static function getColor($params)
    {
        // ✅ Case 1: Custom RGB color present
        if (isset($params['P']) && isset($params['R']) && isset($params['G']) && isset($params['B'])) {
            $r = intval($params['R']);
            $g = intval($params['G']);
            $b = intval($params['B']);
            return sprintf('#%02X%02X%02X', $r, $g, $b);
        }

        // ✅ Case 2: Preset Valorant color code
        $colors = [
            '0' => '#00FF00', // Green
            '1' => '#FFFFFF', // White
            '2' => '#00FFFF', // Cyan
            '3' => '#FFFF00', // Yellow
            '4' => '#0000FF', // Blue
            '5' => '#FF00FF', // Magenta
            '6' => '#FFA500', // Orange
            '7' => '#FF0000', // Red
            '8' => '#808080', // Gray
        ];

        return $colors[$params['c'] ?? '1'] ?? '#FFFFFF';
    }

    /**
     * Generate SVG for given crosshair code
     */
    public static function generateSVG($code, $size = 160)
    {
        if (empty($code)) {
            return self::generateDefaultSVG($size);
        }

        $params = self::parseCrosshairCode($code);
        $center = $size / 2;
        $color = self::getColor($params);
        $outlineColor = '#000000';

        // Outline
        $outlineEnabled = ($params['o'] ?? '0') === '1';
        $outlineOpacity = ($params['a'] ?? 100) / 100;
        $outlineThickness = ($params['t'] ?? 2);

        // Center dot
        $showDot = ($params['d'] ?? '0') === '1';
        $dotSize = isset($params['z']) ? (float)$params['z'] : 2;
        $dotOpacity = 1;

        // Inner lines
        $innerLen = (float)($params['0l'] ?? 0);
        $innerThick = (float)($params['0t'] ?? 0);
        $innerGap = (float)($params['0o'] ?? 0);
        $innerOpacity = (float)($params['0a'] ?? 1);

        // Outer lines
        $outerLen = (float)($params['1l'] ?? 0);
        $outerThick = (float)($params['1t'] ?? 0);
        $outerGap = (float)($params['1o'] ?? 0);
        $outerOpacity = (float)($params['1a'] ?? 1);

        // Draw
        $scale = 2.5;
        $svg = '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 ' . $size . ' ' . $size . '" xmlns="http://www.w3.org/2000/svg">';

        // Outer lines
        if ($outerLen > 0) {
            $l = $outerLen * $scale;
            $t = $outerThick;
            $g = $outerGap * 0.8;
            $svg .= self::drawLines($center, $l, $t, $g, $color, $outerOpacity, $outlineEnabled, $outlineColor, $outlineThickness, $outlineOpacity);
        }

        // Inner lines
        if ($innerLen > 0) {
            $l = $innerLen * $scale;
            $t = $innerThick;
            $g = $innerGap * 0.8;
            $svg .= self::drawLines($center, $l, $t, $g, $color, $innerOpacity, $outlineEnabled, $outlineColor, $outlineThickness, $outlineOpacity);
        }

        // Center dot
        if ($showDot) {
            $r = $dotSize / 2;
            if ($outlineEnabled) {
                $svg .= sprintf(
                    '<circle cx="%s" cy="%s" r="%s" fill="%s" opacity="%s" />',
                    $center, $center, $r + ($outlineThickness / 2), $outlineColor, $outlineOpacity
                );
            }
            $svg .= sprintf(
                '<circle cx="%s" cy="%s" r="%s" fill="%s" opacity="%s" />',
                $center, $center, $r, $color, $dotOpacity
            );
        }

        $svg .= '</svg>';
        return $svg;
    }

    /**
     * Draw the 4 crosshair lines
     */
    private static function drawLines($center, $length, $thickness, $gap, $color, $opacity, $outlineEnabled, $outlineColor, $outlineThickness, $outlineOpacity)
    {
        $svg = '';
        $lines = [
            ['x1' => $center, 'y1' => $center - $gap - $length, 'x2' => $center, 'y2' => $center - $gap], // top
            ['x1' => $center, 'y1' => $center + $gap, 'x2' => $center, 'y2' => $center + $gap + $length], // bottom
            ['x1' => $center - $gap - $length, 'y1' => $center, 'x2' => $center - $gap, 'y2' => $center], // left
            ['x1' => $center + $gap, 'y1' => $center, 'x2' => $center + $gap + $length, 'y2' => $center], // right
        ];

        foreach ($lines as $line) {
            if ($outlineEnabled) {
                $svg .= sprintf(
                    '<line x1="%s" y1="%s" x2="%s" y2="%s" stroke="%s" stroke-width="%s" opacity="%s" stroke-linecap="square" />',
                    $line['x1'], $line['y1'], $line['x2'], $line['y2'],
                    $outlineColor, $thickness + $outlineThickness, $outlineOpacity
                );
            }
            $svg .= sprintf(
                '<line x1="%s" y1="%s" x2="%s" y2="%s" stroke="%s" stroke-width="%s" opacity="%s" stroke-linecap="square" />',
                $line['x1'], $line['y1'], $line['x2'], $line['y2'],
                $color, $thickness, $opacity
            );
        }

        return $svg;
    }

    /**
     * Default fallback SVG
     */
    private static function generateDefaultSVG($size)
    {
        $center = $size / 2;
        $color = '#FFFFFF';
        return <<<SVG
<svg width="{$size}" height="{$size}" viewBox="0 0 {$size} {$size}" xmlns="http://www.w3.org/2000/svg">
  <g stroke="{$color}" stroke-width="3" fill="none">
    <line x1="{$center}" y1="{$center}-25" x2="{$center}" y2="{$center}-5" stroke-linecap="round" />
    <line x1="{$center}" y1="{$center}+5" x2="{$center}" y2="{$center}+25" stroke-linecap="round" />
    <line x1="{$center}-25" y1="{$center}" x2="{$center}-5" y2="{$center}" stroke-linecap="round" />
    <line x1="{$center}+5" y1="{$center}" x2="{$center}+25" y2="{$center}" stroke-linecap="round" />
    <circle cx="{$center}" cy="{$center}" r="2" fill="{$color}" />
  </g>
</svg>
SVG;
    }
}
