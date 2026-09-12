<?php

namespace App\Enums;

enum SectionEnum: string
{
    case Agamy   = 'agamy';
    case Dekhila = 'dekhila';

    public function label(): string
    {
        return match ($this) {
            self::Agamy   => 'العجمي',
            self::Dekhila => 'الدخيلة',
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
