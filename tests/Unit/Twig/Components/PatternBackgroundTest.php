<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Tests\Unit\Twig\Components;

use Jostkleigrewe\TablerBundle\Enum\ConnectionType;
use Jostkleigrewe\TablerBundle\Enum\PatternIntensity;
use Jostkleigrewe\TablerBundle\Enum\PatternSize;
use Jostkleigrewe\TablerBundle\Enum\PatternSpeed;
use Jostkleigrewe\TablerBundle\Enum\PatternTheme;
use Jostkleigrewe\TablerBundle\Enum\PatternType;
use Jostkleigrewe\TablerBundle\Enum\WavePosition;
use Jostkleigrewe\TablerBundle\Twig\Components\PatternBackground;
use PHPUnit\Framework\TestCase;

final class PatternBackgroundTest extends TestCase
{
    public function testDefaultCssClasses(): void
    {
        $bg = new PatternBackground();

        $classes = $bg->getCssClasses();

        self::assertSame('pattern-bg pattern-particles', $classes);
    }

    public function testCssClassesWithAllOptions(): void
    {
        $bg = new PatternBackground();
        $bg->pattern = PatternType::Waves;
        $bg->theme = PatternTheme::Light;
        $bg->size = PatternSize::Hero;
        $bg->intensity = PatternIntensity::Intense;
        $bg->speed = PatternSpeed::Slow;

        $classes = $bg->getCssClasses();

        self::assertStringContainsString('pattern-bg', $classes);
        self::assertStringContainsString('pattern-waves', $classes);
        self::assertStringContainsString('pattern-light', $classes);
        self::assertStringContainsString('pattern-hero', $classes);
        self::assertStringContainsString('pattern-intense', $classes);
        self::assertStringContainsString('pattern-slow', $classes);
    }

    public function testCssClassesOmitsDefaults(): void
    {
        $bg = new PatternBackground();
        $bg->theme = PatternTheme::Dark; // default
        $bg->size = PatternSize::Auto; // default
        $bg->intensity = PatternIntensity::Medium; // default
        $bg->speed = PatternSpeed::Normal; // default

        $classes = $bg->getCssClasses();

        self::assertStringNotContainsString('pattern-dark', $classes);
        self::assertStringNotContainsString('pattern-auto', $classes);
        self::assertStringNotContainsString('pattern-medium', $classes);
        self::assertStringNotContainsString('pattern-normal', $classes);
    }

    public function testWavesTopClass(): void
    {
        $bg = new PatternBackground();
        $bg->pattern = PatternType::Waves;
        $bg->wavePosition = WavePosition::Top;

        self::assertStringContainsString('pattern-waves-top', $bg->getCssClasses());
    }

    public function testWavesTopOnlyForWaves(): void
    {
        $bg = new PatternBackground();
        $bg->pattern = PatternType::Particles;
        $bg->wavePosition = WavePosition::Top;

        self::assertStringNotContainsString('pattern-waves-top', $bg->getCssClasses());
    }

    public function testCustomCssClass(): void
    {
        $bg = new PatternBackground();
        $bg->class = 'my-custom';

        self::assertStringContainsString('my-custom', $bg->getCssClasses());
    }

    public function testGetParticleRange(): void
    {
        $bg = new PatternBackground();

        self::assertCount(25, $bg->getParticleRange());
        self::assertSame(1, $bg->getParticleRange()[0]);
        self::assertSame(25, $bg->getParticleRange()[24]);
    }

    public function testGetParticleRangeCustomCount(): void
    {
        $bg = new PatternBackground();
        $bg->particleCount = 10;

        self::assertCount(10, $bg->getParticleRange());
    }

    public function testGetParticleRangeMaxCap(): void
    {
        $bg = new PatternBackground();
        $bg->particleCount = 100;

        self::assertCount(25, $bg->getParticleRange());
    }

    public function testGetSsoIcon(): void
    {
        $bg = new PatternBackground();

        self::assertSame('shield-lock', $bg->getSsoIcon(1));
        self::assertSame('key', $bg->getSsoIcon(2));
        self::assertSame('shield-lock', $bg->getSsoIcon(11)); // wraps around
    }

    public function testUseSvgConnections(): void
    {
        $bg = new PatternBackground();

        self::assertFalse($bg->useSvgConnections());

        $bg->connectionType = ConnectionType::Svg;
        self::assertFalse($bg->useSvgConnections()); // not network pattern

        $bg->pattern = PatternType::ParticlesNetwork;
        self::assertTrue($bg->useSvgConnections());

        $bg->connectionType = ConnectionType::Css;
        self::assertFalse($bg->useSvgConnections());
    }

    public function testGetSvgLines(): void
    {
        $bg = new PatternBackground();
        $lines = $bg->getSvgLines();

        self::assertCount(13, $lines);
        self::assertArrayHasKey('x1', $lines[0]);
        self::assertArrayHasKey('y1', $lines[0]);
        self::assertArrayHasKey('x2', $lines[0]);
        self::assertArrayHasKey('y2', $lines[0]);
    }
}
