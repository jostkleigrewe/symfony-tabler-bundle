<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Enum;

use Jostkleigrewe\TablerBundle\Enum\AlertType;
use Jostkleigrewe\TablerBundle\Enum\CodeLanguage;
use Jostkleigrewe\TablerBundle\Enum\CollapsiblePanelVariant;
use Jostkleigrewe\TablerBundle\Enum\ComponentSize;
use Jostkleigrewe\TablerBundle\Enum\ConnectionType;
use Jostkleigrewe\TablerBundle\Enum\ContainerType;
use Jostkleigrewe\TablerBundle\Enum\FeatureCardVariant;
use Jostkleigrewe\TablerBundle\Enum\PageHeaderVariant;
use Jostkleigrewe\TablerBundle\Enum\PatternIntensity;
use Jostkleigrewe\TablerBundle\Enum\PatternSize;
use Jostkleigrewe\TablerBundle\Enum\PatternSpeed;
use Jostkleigrewe\TablerBundle\Enum\PatternTheme;
use Jostkleigrewe\TablerBundle\Enum\PatternType;
use Jostkleigrewe\TablerBundle\Enum\StatCardTrend;
use Jostkleigrewe\TablerBundle\Enum\StepperVariant;
use Jostkleigrewe\TablerBundle\Enum\TablerColor;
use Jostkleigrewe\TablerBundle\Enum\ThemePickerVariant;
use Jostkleigrewe\TablerBundle\Enum\ThemeSwitchSize;
use Jostkleigrewe\TablerBundle\Enum\ThemeSwitchVariant;
use Jostkleigrewe\TablerBundle\Enum\TooltipPlacement;
use Jostkleigrewe\TablerBundle\Enum\WavePosition;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EnumTest extends TestCase
{
    public function testAlertTypeCases(): void
    {
        self::assertSame('success', AlertType::Success->value);
        self::assertSame('info', AlertType::Info->value);
        self::assertSame('warning', AlertType::Warning->value);
        self::assertSame('danger', AlertType::Danger->value);
        self::assertCount(4, AlertType::cases());
    }

    public function testAlertTypeIcons(): void
    {
        self::assertSame('check', AlertType::Success->icon());
        self::assertSame('info-circle', AlertType::Info->icon());
        self::assertSame('alert-triangle', AlertType::Warning->icon());
        self::assertSame('alert-circle', AlertType::Danger->icon());
    }

    public function testCodeLanguageCases(): void
    {
        self::assertSame('php', CodeLanguage::Php->value);
        self::assertSame('twig', CodeLanguage::Twig->value);
        self::assertSame('html.twig', CodeLanguage::HtmlTwig->value);
        self::assertSame('js', CodeLanguage::Js->value);
        self::assertSame('yaml', CodeLanguage::Yaml->value);
        self::assertSame('bash', CodeLanguage::Bash->value);
        self::assertSame('sql', CodeLanguage::Sql->value);
        self::assertCount(13, CodeLanguage::cases());
    }

    #[DataProvider('codeLanguageCssClassProvider')]
    public function testCodeLanguageCssClass(CodeLanguage $language, string $expected): void
    {
        self::assertSame($expected, $language->cssClass());
    }

    /**
     * @return iterable<string, array{CodeLanguage, string}>
     */
    public static function codeLanguageCssClassProvider(): iterable
    {
        yield 'php' => [CodeLanguage::Php, 'language-php'];
        yield 'twig' => [CodeLanguage::Twig, 'language-twig'];
        yield 'html.twig' => [CodeLanguage::HtmlTwig, 'language-twig'];
        yield 'js' => [CodeLanguage::Js, 'language-javascript'];
        yield 'javascript' => [CodeLanguage::JavaScript, 'language-javascript'];
        yield 'yaml' => [CodeLanguage::Yaml, 'language-yaml'];
        yield 'yml' => [CodeLanguage::Yml, 'language-yaml'];
        yield 'bash' => [CodeLanguage::Bash, 'language-bash'];
        yield 'shell' => [CodeLanguage::Shell, 'language-bash'];
        yield 'sql' => [CodeLanguage::Sql, 'language-sql'];
    }

    #[DataProvider('codeLanguageIconProvider')]
    public function testCodeLanguageIcon(CodeLanguage $language, string $expected): void
    {
        self::assertSame($expected, $language->icon());
    }

    /**
     * @return iterable<string, array{CodeLanguage, string}>
     */
    public static function codeLanguageIconProvider(): iterable
    {
        yield 'php' => [CodeLanguage::Php, 'brand-php'];
        yield 'twig' => [CodeLanguage::Twig, 'template'];
        yield 'css' => [CodeLanguage::Css, 'brand-css3'];
        yield 'js' => [CodeLanguage::Js, 'brand-javascript'];
        yield 'json' => [CodeLanguage::Json, 'braces'];
        yield 'sql' => [CodeLanguage::Sql, 'database'];
        yield 'bash' => [CodeLanguage::Bash, 'terminal-2'];
    }

    public function testContainerTypeCssClass(): void
    {
        self::assertSame('container-xl', ContainerType::Xl->cssClass());
        self::assertSame('container-fluid', ContainerType::Fluid->cssClass());
        self::assertSame('', ContainerType::None->cssClass());
    }

    public function testComponentSizeCases(): void
    {
        self::assertSame('sm', ComponentSize::Sm->value);
        self::assertSame('md', ComponentSize::Md->value);
        self::assertSame('lg', ComponentSize::Lg->value);
        self::assertCount(3, ComponentSize::cases());
    }

    public function testTablerColorCases(): void
    {
        self::assertSame('blue', TablerColor::Blue->value);
        self::assertSame('azure', TablerColor::Azure->value);
        self::assertSame('primary', TablerColor::Primary->value);
        self::assertSame('secondary', TablerColor::Secondary->value);
        self::assertCount(18, TablerColor::cases());
    }

    public function testStatCardTrendCases(): void
    {
        self::assertSame('up', StatCardTrend::Up->value);
        self::assertSame('down', StatCardTrend::Down->value);
        self::assertCount(2, StatCardTrend::cases());
    }

    public function testTooltipPlacementCases(): void
    {
        self::assertSame('top', TooltipPlacement::Top->value);
        self::assertSame('bottom', TooltipPlacement::Bottom->value);
        self::assertSame('left', TooltipPlacement::Left->value);
        self::assertSame('right', TooltipPlacement::Right->value);
    }

    public function testPatternTypeCases(): void
    {
        self::assertSame('particles', PatternType::Particles->value);
        self::assertSame('particles-sso', PatternType::ParticlesSso->value);
        self::assertSame('particles-network', PatternType::ParticlesNetwork->value);
        self::assertSame('waves', PatternType::Waves->value);
        self::assertCount(14, PatternType::cases());
    }

    public function testPatternThemeCases(): void
    {
        self::assertSame('dark', PatternTheme::Dark->value);
        self::assertSame('light', PatternTheme::Light->value);
        self::assertSame('gradient', PatternTheme::Gradient->value);
        self::assertSame('transparent', PatternTheme::Transparent->value);
    }

    public function testPatternSizeCases(): void
    {
        self::assertSame('auto', PatternSize::Auto->value);
        self::assertSame('hero', PatternSize::Hero->value);
        self::assertCount(8, PatternSize::cases());
    }

    public function testVariantEnums(): void
    {
        self::assertSame('default', PageHeaderVariant::Default->value);
        self::assertSame('bordered', PageHeaderVariant::Bordered->value);
        self::assertSame('compact', PageHeaderVariant::Compact->value);

        self::assertSame('default', CollapsiblePanelVariant::Default->value);
        self::assertSame('card', CollapsiblePanelVariant::Card->value);
        self::assertSame('subtle', CollapsiblePanelVariant::Subtle->value);

        self::assertSame('default', FeatureCardVariant::Default->value);
        self::assertSame('highlight', FeatureCardVariant::Highlight->value);
        self::assertSame('horizontal', FeatureCardVariant::Horizontal->value);

        self::assertSame('default', StepperVariant::Default->value);
        self::assertSame('compact', StepperVariant::Compact->value);
        self::assertSame('horizontal', StepperVariant::Horizontal->value);

        self::assertSame('toggle', ThemeSwitchVariant::Toggle->value);
        self::assertSame('tristate', ThemeSwitchVariant::Tristate->value);
        self::assertSame('cycle', ThemeSwitchVariant::Cycle->value);

        self::assertSame('normal', ThemeSwitchSize::Normal->value);
        self::assertSame('compact', ThemeSwitchSize::Compact->value);

        self::assertSame('default', ThemePickerVariant::Default->value);
        self::assertSame('compact', ThemePickerVariant::Compact->value);
        self::assertSame('inline', ThemePickerVariant::Inline->value);
    }

    public function testPatternBackgroundEnums(): void
    {
        self::assertSame('subtle', PatternIntensity::Subtle->value);
        self::assertSame('medium', PatternIntensity::Medium->value);
        self::assertSame('intense', PatternIntensity::Intense->value);

        self::assertSame('slow', PatternSpeed::Slow->value);
        self::assertSame('normal', PatternSpeed::Normal->value);
        self::assertSame('fast', PatternSpeed::Fast->value);
        self::assertSame('static', PatternSpeed::Static->value);

        self::assertSame('css', ConnectionType::Css->value);
        self::assertSame('svg', ConnectionType::Svg->value);

        self::assertSame('top', WavePosition::Top->value);
        self::assertSame('bottom', WavePosition::Bottom->value);
        self::assertSame('both', WavePosition::Both->value);
    }
}
