<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\FeatureCardVariant;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
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
    public TablerColor $iconColor = TablerColor::Primary;

    /**
     * DE: Link-URL (optional)
     * EN: Link URL (optional)
     */
    public ?string $linkUrl = null;

    /**
     * DE: Link-Text (optional, default: "Learn more")
     * EN: Link text (optional, default: "Learn more")
     */
    public ?string $linkText = null;

    /**
     * DE: Variante der Darstellung
     * EN: Display variant
     */
    public FeatureCardVariant $variant = FeatureCardVariant::Default;

    /**
     * DE: Card-Höhe 100% (für gleiche Höhen in Grid)
     * EN: Full height card (for equal heights in grid)
     */
    public bool $fullHeight = true;
}
