<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\CodeLanguage;
use Jostkleigrewe\TablerBundle\Twig\Components\CodeBlock;
use PHPUnit\Framework\TestCase;

final class CodeBlockTest extends TestCase
{
    public function testDefaults(): void
    {
        $block = new CodeBlock();

        self::assertSame(CodeLanguage::Php, $block->language);
        self::assertNull($block->title);
        self::assertNull($block->code);
        self::assertFalse($block->lineNumbers);
        self::assertFalse($block->compact);
    }

    public function testGetLanguageClass(): void
    {
        $block = new CodeBlock();

        self::assertSame('language-php', $block->getLanguageClass());

        $block->language = CodeLanguage::Twig;
        self::assertSame('language-twig', $block->getLanguageClass());

        $block->language = CodeLanguage::Bash;
        self::assertSame('language-bash', $block->getLanguageClass());
    }

    public function testGetLanguageIcon(): void
    {
        $block = new CodeBlock();

        self::assertSame('brand-php', $block->getLanguageIcon());

        $block->language = CodeLanguage::Js;
        self::assertSame('brand-javascript', $block->getLanguageIcon());

        $block->language = CodeLanguage::Sql;
        self::assertSame('database', $block->getLanguageIcon());
    }
}
