<?php

namespace App\Enums;

enum CameraType: string
{
    case ANALOG = 'analog';
    case DIGITAL = 'digital';
    case UNKNOWN = 'unknown';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

        public function label(): string
    {
        return match($this) {
            self::ANALOG => 'Analog',
            self::DIGITAL => 'Digital',
            self::UNKNOWN => 'Unknown',
        };
    }
}
