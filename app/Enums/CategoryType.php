<?php

namespace App\Enums;

enum CategoryType: string
{
    case Budget = 'budget';
    case Spending = 'spending';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Budget => 'Budget',
            self::Spending => 'Spending',
        };
    }
}
