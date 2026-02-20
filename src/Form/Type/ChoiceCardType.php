<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DE: FormType für Card-basierte Choice-Auswahl (Checkboxen/Radios).
 *     Rendert Optionen als kompakte Cards in einem responsiven Grid.
 *     Ideal für Grant Types, Feature-Toggles, Kategorien etc.
 *     Teil des Tabler Design System.
 *
 * EN: FormType for card-based choice selection (checkboxes/radios).
 *     Renders options as compact cards in a responsive grid.
 *     Ideal for grant types, feature toggles, categories etc.
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
 * - data-badge: Badge-Text (z.B. "M2M", "Standard", "Beta")
 * - data-badge-class: Badge CSS-Klasse (z.B. "bg-azure-lt", "bg-green-lt")
 *
 * Verwendung / Usage:
 *
 *     use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;
 *
 *     ->add('grantTypes', ChoiceCardType::class, [
 *         'choices' => ['Label A' => 'value_a', 'Label B' => 'value_b'],
 *         'icon' => 'key',
 *         'icon_color' => 'azure',
 *         'columns' => 2,
 *     ])
 *
 * Mit choice_attr für Badges/Descriptions:
 *     ->add('grantTypes', ChoiceCardType::class, [
 *         'choices' => [...],
 *         'choice_attr' => fn($value) => match($value) {
 *             'client_credentials' => ['data-badge' => 'M2M', 'data-badge-class' => 'bg-purple-lt'],
 *             default => [],
 *         },
 *     ])
 */
class ChoiceCardType extends AbstractType
{
    public function getParent(): string
    {
        return ChoiceType::class;
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
        return 'tabler_choice_card';
    }
}
