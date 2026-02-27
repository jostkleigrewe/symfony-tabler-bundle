<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Wrapper für ActionItem-Listen mit optionalem Titel.
 * EN: Wrapper for ActionItem lists with optional title.
 *
 * Usage:
 *   <twig:Tabler:ActionList title="Quick Access">
 *       <twig:Tabler:ActionItem label="Profile" url="/profile" icon="user" />
 *       <twig:Tabler:ActionItem label="Settings" url="/settings" icon="settings" />
 *   </twig:Tabler:ActionList>
 */
#[AsTwigComponent('Tabler:ActionList', template: '@Tabler/components/ActionList.html.twig')]
final class ActionList
{
    /** DE: Titel der Liste / EN: List title */
    public ?string $title = null;

    /** DE: Als Card rendern / EN: Render as card */
    public bool $card = true;

    /** DE: Flush-Style (keine Ränder) / EN: Flush style (no borders) */
    public bool $flush = true;
}
