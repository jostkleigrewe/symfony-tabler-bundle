<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DE: FormType für Card-basierte Entity-Auswahl (Checkboxen/Radios).
 *     Wie ChoiceCardType, aber für Doctrine Entities.
 *     Ideal für Scopes, Rollen, Kategorien, Tags etc.
 *     Teil des Tabler Design System.
 *
 * EN: FormType for card-based entity selection (checkboxes/radios).
 *     Like ChoiceCardType, but for Doctrine entities.
 *     Ideal for scopes, roles, categories, tags etc.
 *     Part of the Tabler Design System.
 *
 * Unterstützte Options / Supported options:
 * - icon: Globales Icon für alle Optionen (Tabler Icon ohne 'ti-' prefix)
 * - icon_color: Globale Icon-Farbe (secondary, primary, azure, etc.)
 * - columns: Grid-Spalten auf md+ (1, 2, 3, 4) - default: 2
 *
 * Unterstützte Data-Attribute pro Choice / Supported data attributes per choice:
 * - data-icon: Überschreibt das globale Icon für diese Option
 * - data-icon-color: Überschreibt die globale Farbe für diese Option
 * - data-description: Kurze Beschreibung unter dem Label
 * - data-badge: Badge-Text (z.B. "Standard", "Custom", "Beta")
 * - data-badge-class: Badge CSS-Klasse (z.B. "bg-azure-lt", "bg-green-lt")
 *
 * Verwendung / Usage:
 *
 *     use Jostkleigrewe\TablerBundle\Form\Type\EntityCardType;
 *
 *     ->add('scopes', EntityCardType::class, [
 *         'class' => Scope::class,
 *         'query_builder' => fn($repo) => $repo->createQueryBuilder('s')->where('s.active = true'),
 *         'choice_label' => fn(Scope $s) => $s->getDisplayName(),
 *         'choice_attr' => fn(Scope $s) => [
 *             'data-icon' => $s->getIcon() ?? 'lock',
 *             'data-icon-color' => $s->getIconColor() ?? 'azure',
 *             'data-description' => $s->getDescription(),
 *             'data-badge' => $s->isStandard() ? 'OIDC' : null,
 *             'data-badge-class' => 'bg-purple-lt',
 *         ],
 *         'columns' => 2,
 *     ])
 */
class EntityCardType extends AbstractType
{
    public function getParent(): string
    {
        return EntityType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'expanded' => true,
            'multiple' => true,
            'icon' => null,
            'icon_color' => 'secondary',
            'columns' => 2,
        ]);

        $resolver->setAllowedTypes('icon', ['null', 'string']);
        $resolver->setAllowedTypes('icon_color', 'string');
        $resolver->setAllowedTypes('columns', 'int');
        $resolver->setAllowedValues('columns', [1, 2, 3, 4]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        // DE: Custom Options an die View übergeben für das Twig Template
        // EN: Pass custom options to view for Twig template
        $view->vars['icon'] = $options['icon'];
        $view->vars['icon_color'] = $options['icon_color'];
        $view->vars['columns'] = $options['columns'];
    }

    public function finishView(FormView $view, FormInterface $form, array $options): void
    {
        // DE: Block-Prefix der Kind-Elemente (Checkboxen) anpassen,
        //     damit das custom Form Theme verwendet wird.
        // EN: Adjust block prefix of child elements (checkboxes)
        //     so the custom form theme is used.
        foreach ($view->children as $child) {
            $child->vars['block_prefixes'][] = 'tabler_choice_card_entry';
        }
    }

    public function getBlockPrefix(): string
    {
        // DE: Nutzt dasselbe Twig Theme wie ChoiceCardType
        // EN: Uses the same Twig theme as ChoiceCardType
        return 'tabler_choice_card';
    }
}
