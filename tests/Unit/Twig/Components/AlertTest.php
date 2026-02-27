<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\AlertType;
use Jostkleigrewe\TablerBundle\Twig\Components\Alert;
use PHPUnit\Framework\TestCase;

final class AlertTest extends TestCase
{
    public function testDefaultIcon(): void
    {
        $alert = new Alert();

        self::assertSame(AlertType::Info, $alert->type);
        self::assertSame('info-circle', $alert->getIcon());
    }

    public function testIconPerType(): void
    {
        $alert = new Alert();

        $alert->type = AlertType::Success;
        self::assertSame('check', $alert->getIcon());

        $alert->type = AlertType::Warning;
        self::assertSame('alert-triangle', $alert->getIcon());

        $alert->type = AlertType::Danger;
        self::assertSame('alert-circle', $alert->getIcon());
    }

    public function testCustomIconOverridesDefault(): void
    {
        $alert = new Alert();
        $alert->type = AlertType::Success;
        $alert->icon = 'star';

        self::assertSame('star', $alert->getIcon());
    }

    public function testPropertyDefaults(): void
    {
        $alert = new Alert();

        self::assertNull($alert->title);
        self::assertNull($alert->text);
        self::assertNull($alert->icon);
        self::assertFalse($alert->dismissible);
        self::assertFalse($alert->important);
    }
}
