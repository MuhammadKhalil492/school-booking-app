<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum PermissionGroupEnum: string implements HasLabel
{
    case Admin = 'admin';
    case Api = 'api';
    case Dashboard = 'dashboard';
    case Web = 'web';

    public function getLabel(): ?string
    {
        return $this->name;

        // or

        return match ($this) {
            self::Admin => 'Admin',
            self::Api => 'Api',
            self::Dashboard => 'Dashboard',
            self::Web => 'Web',
        };
    }
}
