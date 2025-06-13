<?php

namespace App\Enum;

enum BloodTypeEnum: string
{
    case APLUS = 'A+';
    case AMINO = 'A-';
    case BPLUS = 'B+';
    case BMINO = 'B-';
    case ABPLUS = 'AB+';
    case ABMINO = 'AB-';
    case OPLUS = 'O+';
    case OMINO = 'O-';

    public function label(): string
    {
        return match ($this) {
            self::APLUS => 'A+',
            self::AMINO => 'A-',
            self::BPLUS => 'B+',
            self::BMINO => 'B-',
            self::ABPLUS => 'AB+',
            self::ABMINO => 'AB-',
            self::OPLUS => 'O+',
            self::OMINO => 'O-',
        };
    }
}
