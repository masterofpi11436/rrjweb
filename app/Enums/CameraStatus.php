<?php

namespace App\Enums;

enum CameraStatus: string
{
    case GOOD = 'good';
    case NO_VIDEO = 'no_video';
    case BLURRY = 'blurry';
    case IRIS = 'iris';
    case ADJUST = 'adjust';
    case CLEAN = 'clean';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
