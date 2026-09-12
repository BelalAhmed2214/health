<?php

namespace App\Enums;

enum SourceOfMoneyEnum: string
{
    case Charity = 'charity';
    case Country = 'country';

    public function label(): string
    {
        return match ($this) {
            self::Charity => 'تبرعات',
            self::Country => 'الدولة',
        };
    }

    public static function options(): array
    {
        return array_column(
            array_map(fn ($case) => ['value' => $case->value, 'label' => $case->label()], self::cases()),
            'label',
            'value'
        );
    }
}
