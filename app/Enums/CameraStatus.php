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
    case PENDING_DIGITAL_UPGRADE = 'pending_digital_upgrade';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::GOOD => 'Good',
            self::NO_VIDEO => 'No Video',
            self::BLURRY => 'Blurry',
            self::IRIS => 'Iris',
            self::ADJUST => 'Adjust',
            self::CLEAN => 'Clean',
            self::PENDING_DIGITAL_UPGRADE => 'Pending Digital Upgrade',
        };
    }
}
