<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Seitenkopf mit Icon, Titel und optionalen Actions.
 * EN: Page header with icon, title and optional actions.
 *
 * Usage:
 *   <twig:Tabler:PageHeader
 *       title="Dashboard"
 *       pretitle="Overview"
 *       subtitle="Welcome back!"
 *       icon="dashboard"
 *       iconColor="azure"
 *   >
 *       <twig:block name="actions">
 *           <a href="#" class="btn btn-primary">Add New</a>
 *       </twig:block>
 *   </twig:Tabler:PageHeader>
 */
#[AsTwigComponent('Tabler:PageHeader', template: '@Tabler/components/PageHeader.html.twig')]
final class PageHeader
{
    public string $title;
    public ?string $pretitle = null;
    public ?string $subtitle = null;
    public ?string $icon = null;
    public string $iconColor = 'azure';
}
