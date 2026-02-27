<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * DE: Code-Block mit Syntax-Highlighting und Copy-Button.
 * EN: Code block with syntax highlighting and copy button.
 *
 * Usage (als Property - empfohlen für extends-Templates):
 *   <twig:Tabler:CodeBlock language="php" :code="'$foo = 42;'" />
 *
 * Usage (als Content-Block):
 *   <twig:Tabler:CodeBlock language="php">
 *       $builder->add('email', FloatingUnderlineType::class);
 *   </twig:Tabler:CodeBlock>
 */
#[AsTwigComponent('Tabler:CodeBlock', template: '@Tabler/components/CodeBlock.html.twig')]
final class CodeBlock
{
    /**
     * DE: Programmiersprache für Syntax-Klasse
     * EN: Programming language for syntax class
     */
    public string $language = 'php';

    /**
     * DE: Optionaler Titel über dem Code-Block
     * EN: Optional title above the code block
     */
    public ?string $title = null;

    /**
     * DE: Code-Inhalt als Property (Alternative zu Content-Block)
     * EN: Code content as property (alternative to content block)
     */
    public ?string $code = null;

    /**
     * DE: Zeigt Zeilennummern an
     * EN: Show line numbers
     */
    public bool $lineNumbers = false;

    /**
     * DE: Kompakte Darstellung (weniger Padding)
     * EN: Compact display (less padding)
     */
    public bool $compact = false;

    /**
     * DE: Gibt die CSS-Klasse für die Sprache zurück
     * EN: Returns the CSS class for the language
     */
    public function getLanguageClass(): string
    {
        return match ($this->language) {
            'php' => 'language-php',
            'twig', 'html.twig' => 'language-twig',
            'html' => 'language-html',
            'css' => 'language-css',
            'js', 'javascript' => 'language-javascript',
            'json' => 'language-json',
            'yaml', 'yml' => 'language-yaml',
            'bash', 'shell' => 'language-bash',
            'sql' => 'language-sql',
            default => 'language-plaintext',
        };
    }

    /**
     * DE: Gibt ein passendes Icon für die Sprache zurück
     * EN: Returns an appropriate icon for the language
     */
    public function getLanguageIcon(): string
    {
        return match ($this->language) {
            'php' => 'brand-php',
            'twig', 'html.twig' => 'template',
            'html' => 'code',
            'css' => 'brand-css3',
            'js', 'javascript' => 'brand-javascript',
            'json' => 'braces',
            'yaml', 'yml' => 'file-text',
            'bash', 'shell' => 'terminal-2',
            'sql' => 'database',
            default => 'code',
        };
    }
}
