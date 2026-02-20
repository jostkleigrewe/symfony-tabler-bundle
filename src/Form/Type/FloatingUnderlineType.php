<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * DE: Floating Underline Input - Elegantes Input mit schwebendem Label und animierter Unterstreichung.
 *     Kombiniert Material Design Underline mit Floating Label Pattern.
 *     Teil des Tabler Design System.
 *
 * EN: Floating Underline Input - Elegant input with floating label and animated underline.
 *     Combines Material Design underline with floating label pattern.
 *     Part of the Tabler Design System.
 *
 * Verwendung / Usage:
 *
 *     use Jostkleigrewe\TablerBundle\Form\Type\FloatingUnderlineType;
 *
 *     ->add('email', FloatingUnderlineType::class, [
 *         'label' => 'E-Mail-Adresse',
 *         'icon' => 'mail',              // Tabler Icon Name (optional)
 *         'input_type' => 'email',       // HTML input type: text, email, password, tel, url (default: text)
 *         'help' => 'Deine geschäftliche E-Mail',  // Hilfetext (optional)
 *     ])
 *
 *     ->add('password', FloatingUnderlineType::class, [
 *         'label' => 'Passwort',
 *         'icon' => 'lock',
 *         'input_type' => 'password',
 *     ])
 */
class FloatingUnderlineType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'icon' => null,
            'input_type' => 'text',
        ]);

        $resolver->setAllowedTypes('icon', ['null', 'string']);
        $resolver->setAllowedTypes('input_type', 'string');
        $resolver->setAllowedValues('input_type', ['text', 'email', 'password', 'tel', 'url', 'search']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['icon'] = $options['icon'];
        $view->vars['input_type'] = $options['input_type'];
    }

    public function getParent(): string
    {
        return TextType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'tabler_floating_underline';
    }
}
