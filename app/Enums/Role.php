<?php

namespace App\Enums;

enum Role: string
{
    case Superadmin = 'superadmin';
    case AdminClient = 'admin_client';
    case AdminFinance = 'admin_finance';
    case Client = 'client';

    public function label(): string
    {
        return match ($this) {
            self::Superadmin => 'Superadmin',
            self::AdminClient => 'Admin Client',
            self::AdminFinance => 'Admin Finance',
            self::Client => 'Client',
        };
    }
}