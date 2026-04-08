<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\StatCardTrend;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Statistik-Karte für Dashboards mit Label, Wert und optionalem Icon.
 * EN: Statistics card for dashboards with label, value and optional icon.
 *
 * Usage:
 *   <twig:Tabler:StatCard
 *       label="Total Users"
 *       value="1,234"
 *       icon="users"
 *       iconColor="blue"
 *       hint="+12% from last month"
 *       trend="up"
 *   />
 */
#[AsTwigComponent('Tabler:StatCard', template: '@Tabler/components/StatCard.html.twig')]
final class StatCard
{
    public string $label;

    public string $value;

    public ?string $icon = null;

    public TablerColor $iconColor = TablerColor::Azure;

    public ?string $hint = null;

    public ?StatCardTrend $trend = null;

    public ?string $url = null;

    /**
     * DE: Normalisiert String-Werte zu Enums (für Twig-Kompatibilität).
     * EN: Normalizes string values to enums (for Twig compatibility).
     */
    public function mount(
        string|TablerColor|null $iconColor = null,
        string|StatCardTrend|null $trend = null,
    ): void {
        if ($iconColor !== null) {
            $this->iconColor = $iconColor instanceof TablerColor ? $iconColor : TablerColor::tryFrom($iconColor) ?? TablerColor::Azure;
        }
        if ($trend !== null) {
            $this->trend = $trend instanceof StatCardTrend ? $trend : StatCardTrend::tryFrom($trend);
        }
    }
}
