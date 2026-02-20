<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * DE: Symfony Bundle für Tabler Design System FormTypes.
 *     Bietet wiederverwendbare FormTypes mit Floating Labels, Card-Auswahl,
 *     Switches und weitere UI-Komponenten nach Tabler Design System.
 *
 * EN: Symfony bundle for Tabler Design System FormTypes.
 *     Provides reusable FormTypes with floating labels, card selection,
 *     switches and other UI components following Tabler Design System.
 *
 * @see https://tabler.io
 */
final class TablerBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__ . '/..';
    }

    /**
     * @param array<string, mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');
    }
}
