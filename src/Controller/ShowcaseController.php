<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}
