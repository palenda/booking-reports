<?php

namespace App\Enums;

enum BookingStatusEnum: string
{
    case APPROVED = 'approved';
    case REJECTED = 'rejected';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
