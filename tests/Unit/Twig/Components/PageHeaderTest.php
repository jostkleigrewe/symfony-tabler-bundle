<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ContainerType;
use Jostkleigrewe\TablerBundle\Enum\PageHeaderVariant;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Jostkleigrewe\TablerBundle\Twig\Components\PageHeader;
use PHPUnit\Framework\TestCase;

final class PageHeaderTest extends TestCase
{
    public function testDefaults(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';

        self::assertSame(PageHeaderVariant::Default, $header->variant);
        self::assertSame(ContainerType::Xl, $header->container);
        self::assertSame(TablerColor::Azure, $header->iconColor);
        self::assertNull($header->pretitle);
        self::assertNull($header->subtitle);
        self::assertNull($header->icon);
        self::assertSame([], $header->breadcrumbs);
        self::assertSame('', $header->class);
    }

    public function testGetHeaderClassDefault(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';

        $classes = $header->getHeaderClass();

        self::assertStringContainsString('page-header', $classes);
        self::assertStringContainsString('d-print-none', $classes);
        self::assertStringNotContainsString('page-header-border', $classes);
        self::assertStringNotContainsString('page-header-compact', $classes);
    }

    public function testGetHeaderClassBordered(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';
        $header->variant = PageHeaderVariant::Bordered;

        self::assertStringContainsString('page-header-border', $header->getHeaderClass());
    }

    public function testGetHeaderClassCompact(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';
        $header->variant = PageHeaderVariant::Compact;

        self::assertStringContainsString('page-header-compact', $header->getHeaderClass());
    }

    public function testGetHeaderClassWithCustomClass(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';
        $header->class = 'my-custom-class';

        self::assertStringContainsString('my-custom-class', $header->getHeaderClass());
    }

    public function testGetContainerClass(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';

        self::assertSame('container-xl', $header->getContainerClass());

        $header->container = ContainerType::Fluid;
        self::assertSame('container-fluid', $header->getContainerClass());

        $header->container = ContainerType::None;
        self::assertSame('', $header->getContainerClass());
    }

    public function testHasVisualWithIcon(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';
        $header->icon = 'users';

        self::assertTrue($header->hasVisual());
        self::assertFalse($header->hasAvatar());
    }

    public function testHasVisualWithAvatar(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';
        $header->avatar = '/img/avatar.jpg';

        self::assertTrue($header->hasVisual());
        self::assertTrue($header->hasAvatar());
    }

    public function testHasVisualWithInitials(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';
        $header->avatarInitials = 'JD';

        self::assertTrue($header->hasVisual());
        self::assertTrue($header->hasAvatar());
    }

    public function testNoVisual(): void
    {
        $header = new PageHeader();
        $header->title = 'Test';

        self::assertFalse($header->hasVisual());
        self::assertFalse($header->hasAvatar());
    }
}
