<?php

namespace App\Enums;

enum CellFlowUser: string
{
    case ADMIN = 'admin';
    case COMMAND = 'command';
    case MAINTENANCE = 'maintenance';
    case OFFICER = 'officer';
    
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Admin',
            self::COMMAND => 'Command Staff',
            self::MAINTENANCE => 'Maintenance',
            self::OFFICER => 'Officer',
        };
    }
}
