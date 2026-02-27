<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

/**
 * DE: Showcase-Controller zur Demonstration aller Bundle-Features.
 * EN: Showcase controller for demonstrating all bundle features.
 */
#[Route('/tabler/showcase', name: 'tabler_showcase_')]
final class ShowcaseController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('@Tabler/showcase/index.html.twig', [
            'stats' => [
                ['label' => 'Total Users', 'value' => '1,234', 'icon' => 'users', 'trend' => 'up', 'hint' => '+12% this month'],
                ['label' => 'Revenue', 'value' => '€45,678', 'icon' => 'currency-euro', 'trend' => 'up', 'hint' => '+8.3%'],
                ['label' => 'Orders', 'value' => '892', 'icon' => 'shopping-cart', 'trend' => 'down', 'hint' => '-3.2%'],
                ['label' => 'Tickets', 'value' => '23', 'icon' => 'ticket', 'hint' => '5 open'],
            ],
        ]);
    }

    #[Route('/form-types', name: 'form_types', methods: ['GET'])]
    public function formTypes(): Response
    {
        return $this->render('@Tabler/showcase/form_types.html.twig');
    }

    #[Route('/components', name: 'components', methods: ['GET'])]
    public function components(): Response
    {
        return $this->render('@Tabler/showcase/components.html.twig');
    }

    #[Route('/page-headers', name: 'page_headers', methods: ['GET'])]
    public function pageHeaders(): Response
    {
        return $this->render('@Tabler/showcase/page_headers.html.twig');
    }

    #[Route('/patterns', name: 'patterns', methods: ['GET'])]
    public function patterns(): Response
    {
        return $this->render('@Tabler/showcase/patterns.html.twig', [
            'patterns' => [
                'particles' => ['name' => 'Particles', 'description' => 'Schwebende Punkte mit Glow-Effekten'],
                'particles-sso' => ['name' => 'Particles SSO', 'description' => 'SSO-Icons (Keys, Shields, Locks)'],
                'particles-network' => ['name' => 'Network', 'description' => 'Netzwerk-Knoten mit Verbindungen'],
                'waves' => ['name' => 'Waves', 'description' => 'Animierte SVG-Wellen'],
                'geometric' => ['name' => 'Geometric', 'description' => 'Geometrische Formen'],
                'blob' => ['name' => 'Blob', 'description' => 'Organische Blob-Formen'],
                'grid' => ['name' => 'Tech Grid', 'description' => 'Grid mit Scan-Linien und Glow'],
                'topo' => ['name' => 'Topography', 'description' => 'Topografische Linien'],
                'dots' => ['name' => 'Dots', 'description' => 'Dot-Matrix Pattern'],
                'circuit' => ['name' => 'Circuit', 'description' => 'Schaltkreis-Linien'],
                'stream' => ['name' => 'Stream', 'description' => 'Strömende eckige Partikel'],
                'rain' => ['name' => 'Rain', 'description' => 'Regen mit Tropfen und Pfützen'],
                'sandstorm' => ['name' => 'Sandstorm', 'description' => 'Wehende Sandpartikel'],
                'autumn' => ['name' => 'Autumn Leaves', 'description' => 'Fallende Herbstblätter'],
            ],
            'themes' => ['dark', 'light'],
            'sizes' => ['hero', 'section', 'header', 'footer', 'card', 'compact'],
            'intensities' => ['subtle', 'medium', 'intense'],
        ]);
    }

    #[Route('/themes', name: 'themes', methods: ['GET'])]
    public function themes(): Response
    {
        return $this->render('@Tabler/showcase/themes.html.twig', [
            'themes' => [
                'eurip' => ['name' => 'EURIP', 'description' => 'Corporate Blue - das Standard-Theme', 'color' => '#0f3d91', 'colors' => ['#0f3d91', '#1f74ff', '#6366f1']],
                'forest' => ['name' => 'Forest', 'description' => 'Natürliches Grün für umweltbewusste Projekte', 'color' => '#059669', 'colors' => ['#059669', '#10b981', '#34d399']],
                'sunset' => ['name' => 'Sunset', 'description' => 'Warme Orange/Rot-Töne für energetische UIs', 'color' => '#ea580c', 'colors' => ['#ea580c', '#f97316', '#fbbf24']],
                'ocean' => ['name' => 'Ocean', 'description' => 'Tiefes Teal/Cyan für beruhigende Interfaces', 'color' => '#0891b2', 'colors' => ['#0891b2', '#06b6d4', '#22d3ee']],
                'purple' => ['name' => 'Purple', 'description' => 'Royales Lila für kreative Projekte', 'color' => '#7c3aed', 'colors' => ['#7c3aed', '#8b5cf6', '#a855f7']],
                'rose' => ['name' => 'Rose', 'description' => 'Softes Pink für freundliche Anwendungen', 'color' => '#e11d48', 'colors' => ['#e11d48', '#f43f5e', '#fb7185']],
            ],
        ]);
    }

    // --- Stimulus Controllers ---

    #[Route('/controllers', name: 'controllers', methods: ['GET'])]
    public function controllers(): Response
    {
        return $this->render('@Tabler/showcase/controllers/index.html.twig', [
            'controllers' => $this->getControllerDefinitions(),
        ]);
    }

    #[Route('/controllers/{key}', name: 'controller_detail', methods: ['GET'])]
    public function controllerDetail(string $key): Response
    {
        $controllers = $this->getControllerDefinitions();

        if (!isset($controllers[$key])) {
            throw new NotFoundHttpException(sprintf('Controller "%s" not found.', $key));
        }

        return $this->render('@Tabler/showcase/controllers/detail.html.twig', [
            'key' => $key,
            'controller' => $controllers[$key],
            'controllers' => $controllers,
        ]);
    }

    /**
     * DE: Liefert alle Controller-Definitionen.
     * EN: Returns all controller definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    private function getControllerDefinitions(): array
    {
        return [
            'theme' => [
                'name' => 'Theme Controller',
                'description' => 'Dark/Light Mode und Farbschema-Wechsel mit LocalStorage-Persistenz',
                'icon' => 'palette',
                'color' => 'purple',
                'file' => 'theme_controller.js',
                'targets' => [
                    'option' => 'Mode-Buttons (light/dark/auto)',
                    'label' => 'Text-Label für aktuellen Modus',
                    'icon' => 'Icon für aktuellen Modus',
                    'indicator' => 'Visueller Indikator für Tristate',
                    'themeOption' => 'Theme-Auswahl-Buttons',
                    'currentTheme' => 'Text-Anzeige des aktuellen Themes',
                ],
                'values' => [
                    'themes' => ['type' => 'Array', 'default' => "['eurip', 'forest', ...]"],
                    'modeStorageKey' => ['type' => 'String', 'default' => 'tabler-theme-mode'],
                    'themeStorageKey' => ['type' => 'String', 'default' => 'tabler-theme-color'],
                ],
                'actions' => [
                    'choose' => 'Modus wählen (light/dark/auto) via data-theme-value',
                    'toggle' => 'Zwischen Light und Dark umschalten',
                    'cycle' => 'Zyklisch durch Light → Dark → Auto',
                    'selectTheme' => 'Farbschema wählen via data-theme',
                ],
                'events' => [
                    'theme:themeChanged' => 'Wird bei Theme-Wechsel dispatched (detail: { theme })',
                ],
            ],
            'clipboard' => [
                'name' => 'Clipboard Controller',
                'description' => 'Generische Copy-to-Clipboard Funktionalität mit Fallback für ältere Browser',
                'icon' => 'clipboard-copy',
                'color' => 'green',
                'file' => 'clipboard_controller.js',
                'targets' => [
                    'source' => 'Element mit dem zu kopierenden Inhalt',
                    'sourceCurl' => 'Alternative Source für cURL-Modus',
                    'button' => 'Copy-Button (für Button-Feedback)',
                    'icon' => 'Icon im Button (für Icon-Feedback)',
                    'text' => 'Text im Button (für Text-Feedback)',
                ],
                'values' => [
                    'text' => ['type' => 'String', 'default' => ''],
                    'separator' => ['type' => 'String', 'default' => ''],
                    'successText' => ['type' => 'String', 'default' => 'Kopiert!'],
                    'successDuration' => ['type' => 'Number', 'default' => '2000'],
                ],
                'actions' => [
                    'copy' => 'Kopiert Inhalt in die Zwischenablage (mode-param: code|curl)',
                ],
                'events' => [],
            ],
            'sidebar' => [
                'name' => 'Sidebar Controller',
                'description' => 'Sidebar-Collapse mit Mobile-Backdrop und LocalStorage-Persistenz',
                'icon' => 'layout-sidebar-left-collapse',
                'color' => 'azure',
                'file' => 'sidebar_controller.js',
                'targets' => [],
                'values' => [
                    'storageKey' => ['type' => 'String', 'default' => 'tabler-sidebar-state'],
                    'menuId' => ['type' => 'String', 'default' => 'sidebar-menu'],
                    'collapsedClass' => ['type' => 'String', 'default' => 'sidebar-collapsed'],
                    'breakpoint' => ['type' => 'Number', 'default' => '992'],
                ],
                'actions' => [
                    'toggle' => 'Sidebar ein-/ausklappen',
                    'expand' => 'Sidebar ausklappen',
                    'collapse' => 'Sidebar einklappen',
                ],
                'events' => [],
            ],
            'modal-frame' => [
                'name' => 'Modal Frame Controller',
                'description' => 'Modal mit dynamisch geladenem Content via fetch (Turbo-kompatibel)',
                'icon' => 'browser',
                'color' => 'orange',
                'file' => 'modal-frame_controller.js',
                'targets' => [],
                'values' => [
                    'modal' => ['type' => 'String', 'default' => '(required)'],
                    'container' => ['type' => 'String', 'default' => '(required)'],
                    'loadingHtml' => ['type' => 'String', 'default' => '(spinner)'],
                ],
                'actions' => [
                    'open' => 'Modal öffnen und Content laden',
                ],
                'events' => [
                    'modal-frame:loaded' => 'Dispatched nach erfolgreichem Laden',
                ],
            ],
            'required-checkbox' => [
                'name' => 'Required Checkbox Controller',
                'description' => 'Verhindert das Abwählen von Pflicht-Checkboxen (für ChoiceCardType)',
                'icon' => 'checkbox',
                'color' => 'red',
                'file' => 'required_checkbox_controller.js',
                'targets' => [
                    'checkbox' => 'Die Checkbox die nicht abgewählt werden darf',
                ],
                'values' => [],
                'actions' => [
                    'prevent' => 'Verhindert click wenn checked',
                    'enforce' => 'Stellt sicher dass checked bleibt',
                ],
                'events' => [],
            ],
        ];
    }
}
