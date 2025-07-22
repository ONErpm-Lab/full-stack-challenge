<?php

namespace App\Enums;

enum PendingIsrcStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Failed = 'failed';
    case NotFound = 'not_found';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
