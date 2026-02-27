<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ComponentSize;
use Jostkleigrewe\TablerBundle\Enum\ContainerType;
use Jostkleigrewe\TablerBundle\Enum\PageHeaderVariant;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
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
    public TablerColor $iconColor = TablerColor::Azure;

    /** DE: Avatar-Bild-URL (ersetzt Icon) / EN: Avatar image URL (replaces icon) */
    public ?string $avatar = null;

    /** DE: Avatar-Initialen als Fallback / EN: Avatar initials as fallback */
    public ?string $avatarInitials = null;

    /** DE: Avatar/Icon-Größe / EN: Avatar/icon size */
    public ComponentSize $avatarSize = ComponentSize::Lg;

    // ===== Varianten & Layout =====

    /**
     * DE: Header-Variante
     * EN: Header variant
     */
    public PageHeaderVariant $variant = PageHeaderVariant::Default;

    /**
     * DE: Container-Typ
     * EN: Container type
     */
    public ContainerType $container = ContainerType::Xl;

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
     */
    public TablerColor $statusColor = TablerColor::Secondary;

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
    public TablerColor $progressColor = TablerColor::Primary;

    // ===== CSS Klasse =====

    /** DE: Zusätzliche CSS-Klassen / EN: Additional CSS classes */
    public string $class = '';

    /**
     * DE: Normalisiert String-Werte zu Enums (für Twig-Kompatibilität).
     * EN: Normalizes string values to enums (for Twig compatibility).
     */
    public function mount(
        string|TablerColor|null $iconColor = null,
        string|ComponentSize|null $avatarSize = null,
        string|PageHeaderVariant|null $variant = null,
        string|ContainerType|null $container = null,
        string|TablerColor|null $statusColor = null,
        string|TablerColor|null $progressColor = null,
    ): void {
        if ($iconColor !== null) {
            $this->iconColor = $iconColor instanceof TablerColor ? $iconColor : TablerColor::tryFrom($iconColor) ?? TablerColor::Azure;
        }
        if ($avatarSize !== null) {
            $this->avatarSize = $avatarSize instanceof ComponentSize ? $avatarSize : ComponentSize::tryFrom($avatarSize) ?? ComponentSize::Lg;
        }
        if ($variant !== null) {
            $this->variant = $variant instanceof PageHeaderVariant ? $variant : PageHeaderVariant::tryFrom($variant) ?? PageHeaderVariant::Default;
        }
        if ($container !== null) {
            $this->container = $container instanceof ContainerType ? $container : ContainerType::tryFrom($container) ?? ContainerType::Xl;
        }
        if ($statusColor !== null) {
            $this->statusColor = $statusColor instanceof TablerColor ? $statusColor : TablerColor::tryFrom($statusColor) ?? TablerColor::Secondary;
        }
        if ($progressColor !== null) {
            $this->progressColor = $progressColor instanceof TablerColor ? $progressColor : TablerColor::tryFrom($progressColor) ?? TablerColor::Primary;
        }
    }

    /**
     * DE: Berechnet die Container-CSS-Klasse
     * EN: Calculates the container CSS class
     */
    public function getContainerClass(): string
    {
        return $this->container->cssClass();
    }

    /**
     * DE: Berechnet die Header-CSS-Klassen
     * EN: Calculates the header CSS classes
     */
    public function getHeaderClass(): string
    {
        $classes = ['page-header', 'd-print-none'];

        if ($this->variant === PageHeaderVariant::Bordered) {
            $classes[] = 'page-header-border';
        }

        if ($this->variant === PageHeaderVariant::Compact) {
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
