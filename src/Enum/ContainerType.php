<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Container-Typ für Layout-Breite.
 * EN: Container type for layout width.
 */
enum ContainerType: string
{
    case Xl = 'xl';
    case Fluid = 'fluid';
    case None = 'none';

    /**
     * DE: Gibt die CSS-Klasse zurück.
     * EN: Returns the CSS class.
     */
    public function cssClass(): string
    {
        return match ($this) {
            self::Fluid => 'container-fluid',
            self::None => '',
            self::Xl => 'container-xl',
        };
    }
}
