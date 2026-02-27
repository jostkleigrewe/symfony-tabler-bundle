<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\CodeLanguage;
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
    public CodeLanguage $language = CodeLanguage::Php;

    /**
     * DE: Optionaler Titel über dem Code-Block
     * EN: Optional title above the code block
     */
    public ?string $title = null;

    /**
     * DE: Normalisiert String-Werte zu Enums (für Twig-Kompatibilität).
     * EN: Normalizes string values to enums (for Twig compatibility).
     */
    public function mount(string|CodeLanguage|null $language = null): void
    {
        if ($language !== null) {
            $this->language = $language instanceof CodeLanguage
                ? $language
                : CodeLanguage::tryFrom($language) ?? CodeLanguage::Php;
        }
    }

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
        return $this->language->cssClass();
    }

    /**
     * DE: Gibt ein passendes Icon für die Sprache zurück
     * EN: Returns an appropriate icon for the language
     */
    public function getLanguageIcon(): string
    {
        return $this->language->icon();
    }
}
