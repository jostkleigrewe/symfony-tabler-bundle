<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Leerer Zustand für Listen ohne Einträge oder Suchergebnisse.
 * EN: Empty state for lists without entries or search results.
 *
 * Usage:
 *   <twig:Tabler:EmptyState
 *       title="No results found"
 *       text="Try adjusting your search criteria"
 *       icon="search"
 *   />
 *
 *   <twig:Tabler:EmptyState
 *       title="No users yet"
 *       text="Add your first user to get started"
 *       icon="users"
 *       actionUrl="/users/new"
 *       actionLabel="Add User"
 *   />
 */
#[AsTwigComponent('Tabler:EmptyState', template: '@Tabler/components/EmptyState.html.twig')]
final class EmptyState
{
    public string $title;

    public ?string $text = null;

    public string $icon = 'inbox';

    public TablerColor $iconColor = TablerColor::Secondary;

    public ?string $actionUrl = null;

    public ?string $actionLabel = null;

    public TablerColor $actionVariant = TablerColor::Primary;
}
