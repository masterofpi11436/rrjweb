<?php

namespace App\Enums;

enum TrainingUser: string
{
    case ADMIN = 'admin';
    case DIRECTOR = 'director';
    case UNIT = 'unit';
    case SUPERVISOR = 'supervisor';
    case SERGEANT = 'sergeant';
    case FTO = 'fto';
    case TRAINEE = 'trainee';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match($this) {
            self::ADMIN => 'Admin',
            self::DIRECTOR => 'Director of Operations',
            self::UNIT => 'Unit Manager',
            self::SUPERVISOR => 'Supervisor',
            self::SERGEANT => 'Sergeant',
            self::FTO => 'FTO',
            self::TRAINEE => 'Trainee',
        };
    }
}
