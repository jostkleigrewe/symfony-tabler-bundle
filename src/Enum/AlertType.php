<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Alert-Typen mit Standard-Icons.
 * EN: Alert types with default icons.
 */
enum AlertType: string
{
    case Success = 'success';
    case Info = 'info';
    case Warning = 'warning';
    case Danger = 'danger';

    /**
     * DE: Standard-Icon für diesen Alert-Typ.
     * EN: Default icon for this alert type.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Success => 'check',
            self::Warning => 'alert-triangle',
            self::Danger => 'alert-circle',
            self::Info => 'info-circle',
        };
    }
}
