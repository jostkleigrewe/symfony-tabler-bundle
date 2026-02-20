<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DE: Generischer FormType für Card-basierte Mehrfachauswahl.
 *     Rendert Checkboxen als schöne Cards mit Icons, Badges und Beschreibungen.
 *     Verwendbar für Scopes, Rollen, Permissions, Features etc.
 *     Teil des Tabler Design System.
 *
 * EN: Generic FormType for card-based multiple selection.
 *     Renders checkboxes as nice cards with icons, badges and descriptions.
 *     Usable for scopes, roles, permissions, features etc.
 *     Part of the Tabler Design System.
 *
 * Unterstützte Data-Attribute / Supported data attributes:
 * - data-icon: Tabler Icon Name (ohne 'ti-' prefix, z.B. 'lock', 'shield')
 * - data-icon-color: Avatar-Hintergrundfarbe (azure, green, purple, orange, etc.)
 * - data-badge: Badge-Text (z.B. "Standard", "OIDC", "Custom")
 * - data-badge-class: Badge CSS-Klasse (z.B. "bg-purple-lt", "bg-cyan-lt")
 * - data-code: Technischer Code für code-Anzeige (z.B. Scope-Name, Permission-Slug)
 * - data-description: Beschreibungstext unter dem Label
 * - data-indicator-icon: Zusätzliches Indicator-Icon (z.B. 'eye-off' für "no consent")
 * - data-indicator-class: CSS-Klasse für Indicator-Badge (z.B. "bg-yellow-lt")
 * - data-indicator-title: Tooltip für Indicator
 *
 * Verwendung / Usage:
 *
 *     use Jostkleigrewe\TablerBundle\Form\Type\CardSelectType;
 *
 *     ->add('scopes', CardSelectType::class, [
 *         'class' => Scope::class,
 *         'query_builder' => fn() => ...,
 *         'choice_label' => fn(Scope $s) => $s->getDisplayName(),
 *         'choice_attr' => fn(Scope $s) => [
 *             'data-icon' => $s->getIcon() ?? 'lock',
 *             'data-icon-color' => $s->getIconColor() ?? 'secondary',
 *             'data-badge' => $s->isStandard() ? 'OIDC-Standard' : null,
 *             'data-badge-class' => 'bg-purple-lt',
 *             'data-code' => $s->getName(),
 *             'data-description' => $s->getDescription(),
 *         ],
 *     ])
 */
class CardSelectType extends AbstractType
{
    public function getParent(): string
    {
        return EntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'multiple' => true,
            'expanded' => true,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'tabler_card_select';
    }
}
