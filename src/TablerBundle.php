<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle;

use Symfony\Component\AssetMapper\AssetMapperInterface;
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

    /**
     * DE: Registriert Bundle-Assets für AssetMapper.
     * EN: Registers bundle assets for AssetMapper.
     */
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        if (! $this->isAssetMapperAvailable($builder)) {
            return;
        }

        $builder->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__ . '/../assets/controllers' => '@jostkleigrewe/tabler-bundle',
                    __DIR__ . '/../assets/styles' => '@jostkleigrewe/tabler-bundle/styles',
                ],
            ],
        ]);
    }

    /**
     * DE: Prüft ob AssetMapper verfügbar ist.
     * EN: Checks if AssetMapper is available.
     */
    private function isAssetMapperAvailable(ContainerBuilder $builder): bool
    {
        if (! interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        /** @var array<string, array{path: string}> $bundlesMetadata */
        $bundlesMetadata = $builder->getParameter('kernel.bundles_metadata');

        if (! isset($bundlesMetadata['FrameworkBundle'])) {
            return false;
        }

        return is_file($bundlesMetadata['FrameworkBundle']['path'] . '/Resources/config/asset_mapper.php');
    }
}
