<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Integration\Form\Type;

use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Test\TypeTestCase;

final class SwitchTypeTest extends TypeTestCase
{
    public function testBlockPrefix(): void
    {
        $form = $this->factory->create(SwitchType::class);

        self::assertSame('tabler_switch', $form->getConfig()->getType()->getBlockPrefix());
    }

    public function testParentIsCheckboxType(): void
    {
        $form = $this->factory->create(SwitchType::class);
        $parent = $form->getConfig()->getType()->getParent();

        self::assertNotNull($parent);
        self::assertInstanceOf(CheckboxType::class, $parent->getInnerType());
    }

    public function testSubmitTrue(): void
    {
        $form = $this->factory->create(SwitchType::class);
        $form->submit('1');

        self::assertTrue($form->isSynchronized());
        self::assertTrue($form->getData());
    }

    public function testSubmitFalse(): void
    {
        $form = $this->factory->create(SwitchType::class);
        $form->submit(null);

        self::assertTrue($form->isSynchronized());
        self::assertFalse($form->getData());
    }
}
