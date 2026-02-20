<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

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
    public string $iconColor = 'azure';
    public ?string $hint = null;
    public ?string $trend = null; // 'up', 'down', null
    public ?string $url = null;
}
