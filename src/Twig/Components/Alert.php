<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\AlertType;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Alert-Komponente für Benachrichtigungen und Hinweise.
 * EN: Alert component for notifications and notices.
 *
 * Usage:
 *   <twig:Tabler:Alert type="success" title="Saved!" />
 *
 *   <twig:Tabler:Alert
 *       type="warning"
 *       title="Warning"
 *       text="This action cannot be undone."
 *       :dismissible="true"
 *   />
 *
 *   <twig:Tabler:Alert type="info" icon="info-circle">
 *       Custom content with <strong>HTML</strong> support.
 *   </twig:Tabler:Alert>
 */
#[AsTwigComponent('Tabler:Alert', template: '@Tabler/components/Alert.html.twig')]
final class Alert
{
    public AlertType $type = AlertType::Info;

    public ?string $title = null;

    public ?string $text = null;

    public ?string $icon = null;

    public bool $dismissible = false;

    public bool $important = false; // DE: Gefüllter Hintergrund // EN: Filled background style

    public function getIcon(): string
    {
        if ($this->icon !== null) {
            return $this->icon;
        }

        return $this->type->icon();
    }
}
