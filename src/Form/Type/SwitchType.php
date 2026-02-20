<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * DE: Tabler Switch FormType - Rendert eine Checkbox als Tabler Switch.
 *     Teil des Tabler Design System.
 *
 * EN: Tabler Switch FormType - Renders a checkbox as Tabler switch.
 *     Part of the Tabler Design System.
 *
 * Verwendung / Usage:
 *
 *     use Jostkleigrewe\TablerBundle\Form\Type\SwitchType;
 *
 *     ->add('isActive', SwitchType::class, [
 *         'label' => 'my.label.key',
 *         'help' => 'my.hint.key',  // Optional
 *     ])
 */
class SwitchType extends AbstractType
{
    public function getParent(): string
    {
        return CheckboxType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'tabler_switch';
    }
}
