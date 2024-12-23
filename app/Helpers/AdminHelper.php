<?php

namespace App\Helpers;

use App\Enums\PermissionGroupEnum;

/**
 * Get Permission Group naame timestamp using laravel carbon
 */
if (!function_exists('booking_app_get_permission_group')) {
    function booking_app_get_permission_group()
    {
        $group_names =  PermissionGroupEnum::class;
        return $group_names;
    }
}
