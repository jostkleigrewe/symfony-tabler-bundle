<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ThemeSwitchSize;
use Jostkleigrewe\TablerBundle\Enum\ThemeSwitchVariant;
use Jostkleigrewe\TablerBundle\Twig\Components\ThemeSwitch;
use PHPUnit\Framework\TestCase;

final class ThemeSwitchTest extends TestCase
{
    public function testDefaults(): void
    {
        $switch = new ThemeSwitch();

        self::assertSame(ThemeSwitchVariant::Toggle, $switch->variant);
        self::assertSame(ThemeSwitchSize::Normal, $switch->size);
        self::assertSame('Switch theme', $switch->title);
        self::assertFalse($switch->showLabel);
    }

    public function testGetCssClassDefault(): void
    {
        $switch = new ThemeSwitch();

        self::assertSame('tabler-theme-switch', $switch->getCssClass());
    }

    public function testGetCssClassTristate(): void
    {
        $switch = new ThemeSwitch();
        $switch->variant = ThemeSwitchVariant::Tristate;

        self::assertStringContainsString('tabler-theme-switch--tristate', $switch->getCssClass());
    }

    public function testGetCssClassCycle(): void
    {
        $switch = new ThemeSwitch();
        $switch->variant = ThemeSwitchVariant::Cycle;

        self::assertStringContainsString('tabler-theme-switch--cycle', $switch->getCssClass());
    }

    public function testGetCssClassCompact(): void
    {
        $switch = new ThemeSwitch();
        $switch->size = ThemeSwitchSize::Compact;

        self::assertStringContainsString('tabler-theme-switch-compact', $switch->getCssClass());
    }

    public function testGetDataActionToggle(): void
    {
        $switch = new ThemeSwitch();

        self::assertSame('click->theme#toggle', $switch->getDataAction());
    }

    public function testGetDataActionTristate(): void
    {
        $switch = new ThemeSwitch();
        $switch->variant = ThemeSwitchVariant::Tristate;

        self::assertSame('click->theme#choosePosition', $switch->getDataAction());
    }

    public function testGetDataActionCycle(): void
    {
        $switch = new ThemeSwitch();
        $switch->variant = ThemeSwitchVariant::Cycle;

        self::assertSame('click->theme#cycle', $switch->getDataAction());
    }
}
