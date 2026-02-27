<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Animierte Hintergrund-Patterns für beliebige Container.
 *     Kann für Hero-Sections, Headers, Footers, Cards, Divider etc. verwendet werden.
 *
 * EN: Animated background patterns for any container.
 *     Can be used for hero sections, headers, footers, cards, dividers etc.
 *
 * Verwendung / Usage:
 *   <twig:PatternBackground pattern="particles-sso" theme="dark" size="hero">
 *       <div class="container">...</div>
 *   </twig:PatternBackground>
 *
 * @api
 */
#[AsTwigComponent('PatternBackground', template: '@Tabler/components/PatternBackground.html.twig')]
final class PatternBackground
{
    /**
     * DE: Pattern-Typ
     * EN: Pattern type
     *
     * Optionen / Options:
     * - particles        : Schwebende Punkte
     * - particles-sso    : SSO-Icons (Keys, Shields, Locks)
     * - particles-network: Netzwerk-Knoten mit Verbindungen
     * - waves            : Animierte Wellen
     * - geometric        : Geometrische Formen
     * - blob             : Organische Blob-Formen
     * - grid             : Tech-Grid mit Glow
     * - topo             : Topografische Linien
     * - dots             : Dot-Matrix
     * - circuit          : Schaltkreis-Linien
     */
    public string $pattern = 'particles';

    /**
     * DE: Farbmodus
     * EN: Color theme
     *
     * Optionen / Options:
     * - dark        : Dunkler Hintergrund
     * - light       : Heller Hintergrund
     * - gradient    : Gradient-Hintergrund
     * - transparent : Transparenter Hintergrund
     */
    public string $theme = 'dark';

    /**
     * DE: Größen-Preset
     * EN: Size preset
     *
     * Optionen / Options:
     * - hero    : Volle Hero-Section (min-height: 480px)
     * - section : Section-Höhe (min-height: 300px)
     * - header  : Header-Höhe (min-height: 200px)
     * - footer  : Footer-Höhe (min-height: 150px)
     * - card    : Card-Höhe (min-height: 200px)
     * - compact : Kompakt (min-height: 100px)
     * - divider : Trennlinie (min-height: 60px)
     * - auto    : Keine min-height
     */
    public string $size = 'auto';

    /**
     * DE: Intensität der Effekte
     * EN: Effect intensity
     *
     * Optionen / Options:
     * - subtle  : Dezent
     * - medium  : Standard (default)
     * - intense : Intensiv
     */
    public string $intensity = 'medium';

    /**
     * DE: Animationsgeschwindigkeit
     * EN: Animation speed
     *
     * Optionen / Options:
     * - slow   : Langsam (0.5x)
     * - normal : Normal (default)
     * - fast   : Schnell (2x)
     * - static : Keine Animation
     */
    public string $speed = 'normal';

    /**
     * DE: HTML-Tag für den Container
     * EN: HTML tag for the container
     */
    public string $tag = 'div';

    /**
     * DE: Zusätzliche CSS-Klassen
     * EN: Additional CSS classes
     */
    public string $class = '';

    /**
     * DE: SSO-Icons für particles-sso Pattern (Tabler Icons)
     * EN: SSO icons for particles-sso pattern (Tabler Icons)
     *
     * @var array<string>
     */
    public array $ssoIcons = [
        'shield-lock',
        'key',
        'lock',
        'shield-check',
        'fingerprint',
        'user-check',
        'certificate',
        'shield',
        'lock-access',
        'user-shield',
    ];

    /**
     * DE: Anzahl der Partikel (für particles Pattern)
     * EN: Number of particles (for particles pattern)
     */
    public int $particleCount = 25;

    /**
     * DE: Anzahl der Icons (für particles-sso Pattern)
     * EN: Number of icons (for particles-sso pattern)
     */
    public int $iconCount = 20;

    /**
     * DE: Anzahl der Netzwerk-Knoten
     * EN: Number of network nodes
     */
    public int $nodeCount = 12;

    /**
     * DE: Verbindungstyp für Network-Pattern
     * EN: Connection type for network pattern
     *
     * Optionen / Options:
     * - css : CSS-basierte Linien (Standard)
     * - svg : SVG-basierte Linien (exakte Verbindungen)
     */
    public string $connectionType = 'css';

    /**
     * DE: Wellen-Position (top, bottom, both)
     * EN: Wave position (top, bottom, both)
     */
    public string $wavePosition = 'bottom';

    public function getCssClasses(): string
    {
        $classes = ['pattern-bg'];

        // Pattern-Typ
        $classes[] = 'pattern-' . $this->pattern;

        // Theme
        if ($this->theme !== 'dark') {
            $classes[] = 'pattern-' . $this->theme;
        }

        // Size
        if ($this->size !== 'auto') {
            $classes[] = 'pattern-' . $this->size;
        }

        // Intensity
        if ($this->intensity !== 'medium') {
            $classes[] = 'pattern-' . $this->intensity;
        }

        // Speed
        if ($this->speed !== 'normal') {
            $classes[] = 'pattern-' . $this->speed;
        }

        // Wave position
        if ($this->pattern === 'waves' && $this->wavePosition === 'top') {
            $classes[] = 'pattern-waves-top';
        }

        // Custom classes
        if ($this->class !== '') {
            $classes[] = $this->class;
        }

        return implode(' ', $classes);
    }

    /**
     * @return array<int>
     */
    public function getParticleRange(): array
    {
        return range(1, min($this->particleCount, 25));
    }

    /**
     * @return array<int>
     */
    public function getIconRange(): array
    {
        return range(1, min($this->iconCount, 20));
    }

    /**
     * @return array<int>
     */
    public function getNodeRange(): array
    {
        return range(1, min($this->nodeCount, 12));
    }

    /**
     * @return array<int>
     */
    public function getLineRange(): array
    {
        return range(1, 5);
    }

    /**
     * @return array<int>
     */
    public function getEdgeRange(): array
    {
        return range(1, 7);
    }

    public function getSsoIcon(int $index): string
    {
        return $this->ssoIcons[($index - 1) % count($this->ssoIcons)];
    }

    /**
     * DE: Prüft ob SVG-Verbindungen verwendet werden sollen
     * EN: Checks if SVG connections should be used
     */
    public function useSvgConnections(): bool
    {
        return $this->connectionType === 'svg' && $this->pattern === 'particles-network';
    }

    /**
     * DE: SVG-Linien für Network-Pattern (Koordinaten basierend auf Node-Positionen)
     * EN: SVG lines for network pattern (coordinates based on node positions)
     *
     * @return array<array{x1: int, y1: int, x2: int, y2: int}>
     */
    public function getSvgLines(): array
    {
        return [
            ['x1' => 20, 'y1' => 15, 'x2' => 50, 'y2' => 25],
            ['x1' => 50, 'y1' => 25, 'x2' => 80, 'y2' => 20],
            ['x1' => 20, 'y1' => 15, 'x2' => 10, 'y2' => 50],
            ['x1' => 50, 'y1' => 25, 'x2' => 35, 'y2' => 35],
            ['x1' => 80, 'y1' => 20, 'x2' => 75, 'y2' => 45],
            ['x1' => 10, 'y1' => 50, 'x2' => 45, 'y2' => 55],
            ['x1' => 35, 'y1' => 35, 'x2' => 45, 'y2' => 55],
            ['x1' => 75, 'y1' => 45, 'x2' => 90, 'y2' => 65],
            ['x1' => 45, 'y1' => 55, 'x2' => 60, 'y2' => 75],
            ['x1' => 25, 'y1' => 80, 'x2' => 60, 'y2' => 75],
            ['x1' => 60, 'y1' => 75, 'x2' => 85, 'y2' => 85],
            ['x1' => 10, 'y1' => 50, 'x2' => 25, 'y2' => 80],
            ['x1' => 45, 'y1' => 90, 'x2' => 60, 'y2' => 75],
        ];
    }
}
