<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * DE: Symfony Bundle für Tabler Design System FormTypes und Components.
 *     Bietet wiederverwendbare FormTypes mit Floating Labels, Card-Auswahl,
 *     Switches und weitere UI-Komponenten nach Tabler Design System.
 *
 * EN: Symfony bundle for Tabler Design System FormTypes and Components.
 *     Provides reusable FormTypes with floating labels, card selection,
 *     switches and other UI components following Tabler Design System.
 *
 * Installation:
 *     1. Bundle registrieren (automatisch via Flex oder manuell in bundles.php)
 *     2. Form Themes in twig.yaml registrieren:
 *        twig:
 *            form_themes:
 *                - '@Tabler/form/floating_underline.html.twig'
 *                - '@Tabler/form/switch.html.twig'
 *                - '@Tabler/form/choice_card.html.twig'
 *                - '@Tabler/form/card_select.html.twig'
 *     3. CSS einbinden (Asset Mapper oder manuell)
 *
 * @see https://tabler.io
 */
final class TablerBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__ . '/..';
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->booleanNode('register_twig_components')
                    ->defaultTrue()
                    ->info('Register Twig Components (requires symfony/ux-twig-component)')
                ->end()
            ->end();
    }

    /**
     * @param array<string, mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');

        // DE: Twig Components nur registrieren wenn gewünscht und UX-TwigComponent verfügbar
        // EN: Only register Twig Components if desired and UX-TwigComponent available
        if ($config['register_twig_components'] && class_exists('Symfony\UX\TwigComponent\Attribute\AsTwigComponent')) {
            $container->services()
                ->load('Jostkleigrewe\\TablerBundle\\Twig\\Components\\', '../src/Twig/Components/')
                ->autowire()
                ->autoconfigure();
        }
    }
}
