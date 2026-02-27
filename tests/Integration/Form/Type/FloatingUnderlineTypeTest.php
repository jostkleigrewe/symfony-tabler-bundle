<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Integration\Form\Type;

use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Test\TypeTestCase;

final class FloatingUnderlineTypeTest extends TypeTestCase
{
    public function testBlockPrefix(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class);

        self::assertSame('tabler_floating_underline', $form->getConfig()->getType()->getBlockPrefix());
    }

    public function testParentIsTextType(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class);
        $parent = $form->getConfig()->getType()->getParent();

        self::assertNotNull($parent);
        self::assertInstanceOf(TextType::class, $parent->getInnerType());
    }

    public function testDefaultOptions(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class);
        $view = $form->createView();

        self::assertNull($view->vars['icon']);
        self::assertSame('text', $view->vars['input_type']);
    }

    public function testCustomIcon(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class, null, [
            'icon' => 'mail',
        ]);
        $view = $form->createView();

        self::assertSame('mail', $view->vars['icon']);
    }

    public function testInputTypeEmail(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class, null, [
            'input_type' => 'email',
        ]);
        $view = $form->createView();

        self::assertSame('email', $view->vars['input_type']);
    }

    public function testInputTypePassword(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class, null, [
            'input_type' => 'password',
        ]);
        $view = $form->createView();

        self::assertSame('password', $view->vars['input_type']);
    }

    public function testAllowedInputTypes(): void
    {
        $allowed = ['text', 'email', 'password', 'tel', 'url', 'search'];

        foreach ($allowed as $type) {
            $form = $this->factory->create(FloatingUnderlineType::class, null, [
                'input_type' => $type,
            ]);
            $view = $form->createView();

            self::assertSame($type, $view->vars['input_type']);
        }
    }

    public function testInvalidInputTypeThrows(): void
    {
        $this->expectException(\Symfony\Component\OptionsResolver\Exception\InvalidOptionsException::class);

        $this->factory->create(FloatingUnderlineType::class, null, [
            'input_type' => 'number',
        ]);
    }

    public function testSubmitData(): void
    {
        $form = $this->factory->create(FloatingUnderlineType::class);
        $form->submit('hello@example.com');

        self::assertTrue($form->isSynchronized());
        self::assertSame('hello@example.com', $form->getData());
    }
}
