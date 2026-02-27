<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Seitenkopf mit Icon, Titel, Breadcrumbs und optionalen Actions.
 * EN: Page header with icon, title, breadcrumbs and optional actions.
 *
 * Varianten:
 *   - default: Standard-Layout
 *   - bordered: Mit Unterstrich-Linie
 *   - compact: Reduzierter Abstand
 *
 * Usage:
 *   // DE: Einfacher Header
 *   // EN: Simple header
 *   <twig:Tabler:PageHeader title="Dashboard" />
 *
 *   // DE: Mit Icon und Pretitle
 *   // EN: With icon and pretitle
 *   <twig:Tabler:PageHeader
 *       title="Users"
 *       pretitle="Administration"
 *       subtitle="Manage your team members"
 *       icon="users"
 *       iconColor="blue"
 *   />
 *
 *   // DE: Mit Actions
 *   // EN: With actions
 *   <twig:Tabler:PageHeader title="Clients" icon="apps">
 *       <twig:block name="actions">
 *           <a href="#" class="btn btn-primary">Add New</a>
 *       </twig:block>
 *   </twig:Tabler:PageHeader>
 *
 *   // DE: Mit Breadcrumbs
 *   // EN: With breadcrumbs
 *   <twig:Tabler:PageHeader
 *       title="Edit User"
 *       :breadcrumbs="[
 *           {'label': 'Home', 'url': '/'},
 *           {'label': 'Users', 'url': '/users'},
 *           {'label': 'John Doe'}
 *       ]"
 *   />
 *
 *   // DE: Mit Avatar statt Icon
 *   // EN: With avatar instead of icon
 *   <twig:Tabler:PageHeader
 *       title="John Doe"
 *       subtitle="Senior Developer"
 *       avatar="/avatars/john.jpg"
 *   />
 *
 *   // DE: Mit Status-Badge
 *   // EN: With status badge
 *   <twig:Tabler:PageHeader
 *       title="Order #12345"
 *       status="Processing"
 *       statusColor="warning"
 *   />
 *
 *   // DE: Mit Meta-Informationen
 *   // EN: With meta information
 *   <twig:Tabler:PageHeader
 *       title="ACME Corp"
 *       :meta="[
 *           {'icon': 'mail', 'text': 'contact@acme.com', 'url': 'mailto:contact@acme.com'},
 *           {'icon': 'map-pin', 'text': 'Berlin, Germany'}
 *       ]"
 *   />
 */
#[AsTwigComponent('Tabler:PageHeader', template: '@Tabler/components/PageHeader.html.twig')]
final class PageHeader
{
    // ===== Basis =====

    /** DE: Haupttitel (Pflicht) / EN: Main title (required) */
    public string $title;

    /** DE: Überschrift über dem Titel / EN: Label above title */
    public ?string $pretitle = null;

    /** DE: Beschreibung unter dem Titel / EN: Description below title */
    public ?string $subtitle = null;

    // ===== Icon / Avatar =====

    /** DE: Tabler Icon Name / EN: Tabler icon name */
    public ?string $icon = null;

    /** DE: Icon-Hintergrundfarbe / EN: Icon background color */
    public string $iconColor = 'azure';

    /** DE: Avatar-Bild-URL (ersetzt Icon) / EN: Avatar image URL (replaces icon) */
    public ?string $avatar = null;

    /** DE: Avatar-Initialen als Fallback / EN: Avatar initials as fallback */
    public ?string $avatarInitials = null;

    /** DE: Avatar/Icon-Größe / EN: Avatar/icon size */
    public string $avatarSize = 'lg';

    // ===== Varianten & Layout =====

    /**
     * DE: Header-Variante
     * EN: Header variant
     *
     * @var 'default'|'bordered'|'compact'
     */
    public string $variant = 'default';

    /**
     * DE: Container-Typ
     * EN: Container type
     *
     * @var 'xl'|'fluid'|'none'
     */
    public string $container = 'xl';

    // ===== Breadcrumbs =====

    /**
     * DE: Breadcrumb-Navigation
     * EN: Breadcrumb navigation
     *
     * Format: [['label' => 'Home', 'url' => '/'], ['label' => 'Users', 'url' => '/users'], ['label' => 'Current']]
     *
     * @var array<array{label: string, url?: string}>
     */
    public array $breadcrumbs = [];

    // ===== Status Badge =====

    /** DE: Status-Badge Text / EN: Status badge text */
    public ?string $status = null;

    /**
     * DE: Status-Badge Farbe
     * EN: Status badge color
     *
     * @var 'primary'|'secondary'|'success'|'warning'|'danger'|'info'
     */
    public string $statusColor = 'secondary';

    // ===== Meta-Informationen =====

    /**
     * DE: Zusätzliche Meta-Informationen unter dem Titel
     * EN: Additional meta information below title
     *
     * Format: [['icon' => 'mail', 'text' => 'email@example.com', 'url' => 'mailto:...'], ...]
     *
     * @var array<array{icon?: string, text: string, url?: string}>
     */
    public array $meta = [];

    // ===== Progress (für Wizards) =====

    /**
     * DE: Fortschrittsanzeige (0-100)
     * EN: Progress indicator (0-100)
     */
    public ?int $progress = null;

    /**
     * DE: Fortschritts-Farbe
     * EN: Progress color
     */
    public string $progressColor = 'primary';

    // ===== CSS Klasse =====

    /** DE: Zusätzliche CSS-Klassen / EN: Additional CSS classes */
    public string $class = '';

    /**
     * DE: Berechnet die Container-CSS-Klasse
     * EN: Calculates the container CSS class
     */
    public function getContainerClass(): string
    {
        return match ($this->container) {
            'fluid' => 'container-fluid',
            'none' => '',
            default => 'container-xl',
        };
    }

    /**
     * DE: Berechnet die Header-CSS-Klassen
     * EN: Calculates the header CSS classes
     */
    public function getHeaderClass(): string
    {
        $classes = ['page-header', 'd-print-none'];

        if ($this->variant === 'bordered') {
            $classes[] = 'page-header-border';
        }

        if ($this->variant === 'compact') {
            $classes[] = 'page-header-compact';
        }

        if ($this->class) {
            $classes[] = $this->class;
        }

        return implode(' ', $classes);
    }

    /**
     * DE: Prüft ob Avatar oder Icon angezeigt werden soll
     * EN: Checks if avatar or icon should be displayed
     */
    public function hasVisual(): bool
    {
        return $this->avatar !== null || $this->avatarInitials !== null || $this->icon !== null;
    }

    /**
     * DE: Prüft ob Avatar angezeigt werden soll
     * EN: Checks if avatar should be displayed
     */
    public function hasAvatar(): bool
    {
        return $this->avatar !== null || $this->avatarInitials !== null;
    }
}
