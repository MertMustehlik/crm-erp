<?php

namespace App\Enums;

enum CustomerType: string
{
    case INDIVIDUAL = 'individual';
    case CORPORATE = 'corporate';


    public function label(): string
    {
        return match ($this) {
            self::INDIVIDUAL => 'Bireysel',
            self::CORPORATE => 'Kurumsal',
        };
    }
}
