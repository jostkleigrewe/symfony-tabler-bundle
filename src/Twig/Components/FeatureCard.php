<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Feature-Card für Marketing-Seiten und Feature-Listen.
 *     Zeigt ein Feature mit Icon, Titel, Beschreibung und optionalem Link.
 * EN: Feature card for marketing pages and feature lists.
 *     Displays a feature with icon, title, description and optional link.
 *
 * Usage:
 *   <twig:Tabler:FeatureCard
 *       title="Secure Login"
 *       text="Enterprise-grade security for all your apps"
 *       icon="shield-lock"
 *       iconColor="blue"
 *   />
 *
 *   <twig:Tabler:FeatureCard
 *       title="Quick Integration"
 *       text="Get started in minutes"
 *       icon="code"
 *       linkUrl="/docs"
 *       linkText="Learn more"
 *       variant="highlight"
 *   />
 */
#[AsTwigComponent('Tabler:FeatureCard', template: '@Tabler/components/FeatureCard.html.twig')]
final class FeatureCard
{
    public string $title;
    public string $text;

    /**
     * DE: Tabler Icon Name (ohne ti- Prefix)
     * EN: Tabler icon name (without ti- prefix)
     */
    public ?string $icon = null;

    /**
     * DE: Icon-Farbe (blue, green, purple, orange, red, etc.)
     * EN: Icon color (blue, green, purple, orange, red, etc.)
     */
    public string $iconColor = 'primary';

    /**
     * DE: Link-URL (optional)
     * EN: Link URL (optional)
     */
    public ?string $linkUrl = null;

    /**
     * DE: Link-Text (optional, default: "Mehr erfahren")
     * EN: Link text (optional, default: "Learn more")
     */
    public ?string $linkText = null;

    /**
     * DE: Variante der Darstellung
     * EN: Display variant
     * - 'default': Normale Card
     * - 'highlight': Hervorgehobene Card mit farbigem Rand
     * - 'minimal': Ohne Card-Border
     * - 'horizontal': Icon links, Content rechts
     */
    public string $variant = 'default';

    /**
     * DE: Card-Höhe 100% (für gleiche Höhen in Grid)
     * EN: Full height card (for equal heights in grid)
     */
    public bool $fullHeight = true;
}
