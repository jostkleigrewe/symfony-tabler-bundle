<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Unterstützte Programmiersprachen für CodeBlock.
 * EN: Supported programming languages for CodeBlock.
 */
enum CodeLanguage: string
{
    case Php = 'php';
    case Twig = 'twig';
    case HtmlTwig = 'html.twig';
    case Html = 'html';
    case Css = 'css';
    case Js = 'js';
    case JavaScript = 'javascript';
    case Json = 'json';
    case Yaml = 'yaml';
    case Yml = 'yml';
    case Bash = 'bash';
    case Shell = 'shell';
    case Sql = 'sql';

    /**
     * DE: CSS-Klasse für Syntax-Highlighting.
     * EN: CSS class for syntax highlighting.
     */
    public function cssClass(): string
    {
        return match ($this) {
            self::Php => 'language-php',
            self::Twig, self::HtmlTwig => 'language-twig',
            self::Html => 'language-html',
            self::Css => 'language-css',
            self::Js, self::JavaScript => 'language-javascript',
            self::Json => 'language-json',
            self::Yaml, self::Yml => 'language-yaml',
            self::Bash, self::Shell => 'language-bash',
            self::Sql => 'language-sql',
        };
    }

    /**
     * DE: Tabler-Icon für die Sprache.
     * EN: Tabler icon for the language.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Php => 'brand-php',
            self::Twig, self::HtmlTwig => 'template',
            self::Html => 'code',
            self::Css => 'brand-css3',
            self::Js, self::JavaScript => 'brand-javascript',
            self::Json => 'braces',
            self::Yaml, self::Yml => 'file-text',
            self::Bash, self::Shell => 'terminal-2',
            self::Sql => 'database',
        };
    }
}
