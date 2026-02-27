<?php

declare(strict_types=1);

namespace Jostkleigrewe\TablerBundle\Enum;

/**
 * DE: Verfügbare Hintergrund-Pattern-Typen.
 * EN: Available background pattern types.
 */
enum PatternType: string
{
    case Particles = 'particles';
    case ParticlesSso = 'particles-sso';
    case ParticlesNetwork = 'particles-network';
    case Waves = 'waves';
    case Geometric = 'geometric';
    case Blob = 'blob';
    case Grid = 'grid';
    case Topo = 'topo';
    case Dots = 'dots';
    case Circuit = 'circuit';
    case Stream = 'stream';
    case Rain = 'rain';
    case Sandstorm = 'sandstorm';
    case Autumn = 'autumn';
}
