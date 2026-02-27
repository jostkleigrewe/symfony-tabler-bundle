<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Tabler-Farbpalette für Icons, Badges, Status-Elemente.
 * EN: Tabler color palette for icons, badges, status elements.
 */
enum TablerColor: string
{
    case Blue = 'blue';
    case Azure = 'azure';
    case Indigo = 'indigo';
    case Purple = 'purple';
    case Pink = 'pink';
    case Red = 'red';
    case Orange = 'orange';
    case Yellow = 'yellow';
    case Lime = 'lime';
    case Green = 'green';
    case Teal = 'teal';
    case Cyan = 'cyan';
    case Primary = 'primary';
    case Secondary = 'secondary';
    case Success = 'success';
    case Warning = 'warning';
    case Danger = 'danger';
    case Info = 'info';
}
