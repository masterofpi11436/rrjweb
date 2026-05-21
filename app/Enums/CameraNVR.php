<?php

namespace App\Enums;

enum CameraNVR: string
{
    case NVR1 = 'nvr_1';
    case NVR2 = 'nvr_2';
    case NVR3 = 'nvr_3';
    case NVR4 = 'nvr_4';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

        public function label(): string
    {
        return match($this) {
            self::NVR1 => 'NVR 1',
            self::NVR2 => 'NVR 2',
            self::NVR3 => 'NVR 3',
            self::NVR4 => 'NVR 4',
        };
    }
}
