<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ConnectionType;
use Jostkleigrewe\TablerBundle\Enum\PatternIntensity;
use Jostkleigrewe\TablerBundle\Enum\PatternSize;
use Jostkleigrewe\TablerBundle\Enum\PatternSpeed;
use Jostkleigrewe\TablerBundle\Enum\PatternTheme;
use Jostkleigrewe\TablerBundle\Enum\PatternType;
use Jostkleigrewe\TablerBundle\Enum\WavePosition;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Animierte Hintergrund-Patterns für beliebige Container.
 *     Kann für Hero-Sections, Headers, Footers, Cards, Divider etc. verwendet werden.
 *
 * EN: Animated background patterns for any container.
 *     Can be used for hero sections, headers, footers, cards, dividers etc.
 *
 * Verwendung / Usage:
 *   <twig:Tabler:PatternBackground pattern="particles-sso" theme="dark" size="hero">
 *       <div class="container">...</div>
 *   </twig:Tabler:PatternBackground>
 *
 * @api
 */
#[AsTwigComponent('Tabler:PatternBackground', template: '@Tabler/components/PatternBackground.html.twig')]
final class PatternBackground
{
    /**
     * DE: Pattern-Typ
     * EN: Pattern type
     */
    public PatternType $pattern = PatternType::Particles;

    /**
     * DE: Farbmodus
     * EN: Color theme
     */
    public PatternTheme $theme = PatternTheme::Dark;

    /**
     * DE: Größen-Preset
     * EN: Size preset
     */
    public PatternSize $size = PatternSize::Auto;

    /**
     * DE: Intensität der Effekte
     * EN: Effect intensity
     */
    public PatternIntensity $intensity = PatternIntensity::Medium;

    /**
     * DE: Animationsgeschwindigkeit
     * EN: Animation speed
     */
    public PatternSpeed $speed = PatternSpeed::Normal;

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
     */
    public ConnectionType $connectionType = ConnectionType::Css;

    /**
     * DE: Wellen-Position (top, bottom, both)
     * EN: Wave position (top, bottom, both)
     */
    public WavePosition $wavePosition = WavePosition::Bottom;

    public function getCssClasses(): string
    {
        $classes = ['pattern-bg'];

        // Pattern-Typ
        $classes[] = 'pattern-' . $this->pattern->value;

        // Theme
        if ($this->theme !== PatternTheme::Dark) {
            $classes[] = 'pattern-' . $this->theme->value;
        }

        // Size
        if ($this->size !== PatternSize::Auto) {
            $classes[] = 'pattern-' . $this->size->value;
        }

        // Intensity
        if ($this->intensity !== PatternIntensity::Medium) {
            $classes[] = 'pattern-' . $this->intensity->value;
        }

        // Speed
        if ($this->speed !== PatternSpeed::Normal) {
            $classes[] = 'pattern-' . $this->speed->value;
        }

        // Wave position
        if ($this->pattern === PatternType::Waves && $this->wavePosition === WavePosition::Top) {
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
        return $this->connectionType === ConnectionType::Svg && $this->pattern === PatternType::ParticlesNetwork;
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
            [
                'x1' => 20,
                'y1' => 15,
                'x2' => 50,
                'y2' => 25,
            ],
            [
                'x1' => 50,
                'y1' => 25,
                'x2' => 80,
                'y2' => 20,
            ],
            [
                'x1' => 20,
                'y1' => 15,
                'x2' => 10,
                'y2' => 50,
            ],
            [
                'x1' => 50,
                'y1' => 25,
                'x2' => 35,
                'y2' => 35,
            ],
            [
                'x1' => 80,
                'y1' => 20,
                'x2' => 75,
                'y2' => 45,
            ],
            [
                'x1' => 10,
                'y1' => 50,
                'x2' => 45,
                'y2' => 55,
            ],
            [
                'x1' => 35,
                'y1' => 35,
                'x2' => 45,
                'y2' => 55,
            ],
            [
                'x1' => 75,
                'y1' => 45,
                'x2' => 90,
                'y2' => 65,
            ],
            [
                'x1' => 45,
                'y1' => 55,
                'x2' => 60,
                'y2' => 75,
            ],
            [
                'x1' => 25,
                'y1' => 80,
                'x2' => 60,
                'y2' => 75,
            ],
            [
                'x1' => 60,
                'y1' => 75,
                'x2' => 85,
                'y2' => 85,
            ],
            [
                'x1' => 10,
                'y1' => 50,
                'x2' => 25,
                'y2' => 80,
            ],
            [
                'x1' => 45,
                'y1' => 90,
                'x2' => 60,
                'y2' => 75,
            ],
        ];
    }
}
