<?php

namespace App\Enums;

enum CameraType: string
{
    case ANALOG = 'analog';
    case DIGITAL = 'digital';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
