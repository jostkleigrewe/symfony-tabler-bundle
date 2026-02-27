<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ComponentSize;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Jostkleigrewe\TablerBundle\Twig\Components\ActionItem;
use PHPUnit\Framework\TestCase;

final class ActionItemTest extends TestCase
{
    public function testDefaults(): void
    {
        $item = new ActionItem();
        $item->label = 'Test';

        self::assertSame(TablerColor::Blue, $item->iconColor);
        self::assertSame(TablerColor::Azure, $item->badgeColor);
        self::assertSame(ComponentSize::Md, $item->size);
        self::assertTrue($item->arrow);
        self::assertFalse($item->disabled);
        self::assertNull($item->description);
        self::assertNull($item->url);
        self::assertNull($item->icon);
        self::assertNull($item->badge);
    }

    public function testGetAvatarSizeDefault(): void
    {
        $item = new ActionItem();
        $item->label = 'Test';

        self::assertSame('sm', $item->getAvatarSize());
    }

    public function testGetAvatarSizeSm(): void
    {
        $item = new ActionItem();
        $item->label = 'Test';
        $item->size = ComponentSize::Sm;

        self::assertSame('sm', $item->getAvatarSize());
    }

    public function testGetAvatarSizeLg(): void
    {
        $item = new ActionItem();
        $item->label = 'Test';
        $item->size = ComponentSize::Lg;

        self::assertSame('md', $item->getAvatarSize());
    }
}
