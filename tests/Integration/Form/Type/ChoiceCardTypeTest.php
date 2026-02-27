<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Integration\Form\Type;

use Jostkleigrewe\TablerBundle\Form\Type\ChoiceCardType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Test\TypeTestCase;

final class ChoiceCardTypeTest extends TypeTestCase
{
    public function testBlockPrefix(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['A' => 'a', 'B' => 'b'],
        ]);

        self::assertSame('tabler_choice_card', $form->getConfig()->getType()->getBlockPrefix());
    }

    public function testParentIsChoiceType(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['A' => 'a'],
        ]);
        $parent = $form->getConfig()->getType()->getParent();

        self::assertNotNull($parent);
        self::assertInstanceOf(ChoiceType::class, $parent->getInnerType());
    }

    public function testDefaultsExpandedAndMultiple(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['A' => 'a', 'B' => 'b'],
        ]);

        self::assertTrue($form->getConfig()->getOption('expanded'));
        self::assertTrue($form->getConfig()->getOption('multiple'));
    }

    public function testDefaultViewVars(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['A' => 'a', 'B' => 'b'],
        ]);
        $view = $form->createView();

        self::assertNull($view->vars['icon']);
        self::assertSame('secondary', $view->vars['icon_color']);
        self::assertSame(2, $view->vars['columns']);
    }

    public function testCustomViewVars(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['A' => 'a', 'B' => 'b'],
            'icon' => 'key',
            'icon_color' => 'azure',
            'columns' => 3,
        ]);
        $view = $form->createView();

        self::assertSame('key', $view->vars['icon']);
        self::assertSame('azure', $view->vars['icon_color']);
        self::assertSame(3, $view->vars['columns']);
    }

    public function testInvalidColumnsThrows(): void
    {
        $this->expectException(\Symfony\Component\OptionsResolver\Exception\InvalidOptionsException::class);

        $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['A' => 'a'],
            'columns' => 5,
        ]);
    }

    public function testFinishViewAddsChildBlockPrefix(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['Alpha' => 'a', 'Beta' => 'b'],
        ]);
        $view = $form->createView();

        foreach ($view->children as $child) {
            self::assertContains('tabler_choice_card_entry', $child->vars['block_prefixes']);
        }
    }

    public function testSubmitData(): void
    {
        $form = $this->factory->create(ChoiceCardType::class, null, [
            'choices' => ['Alpha' => 'a', 'Beta' => 'b', 'Gamma' => 'c'],
        ]);
        $form->submit(['a', 'c']);

        self::assertTrue($form->isSynchronized());
        self::assertSame(['a', 'c'], $form->getData());
    }
}
