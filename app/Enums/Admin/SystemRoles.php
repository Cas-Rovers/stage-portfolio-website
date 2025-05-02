<?php

namespace App\Enums\Admin;

use App\Traits\EnumValues;

enum SystemRoles: string
{
    use EnumValues;

    case SUPER_ADMIN = 'Super Admin';
    case ADMIN = 'Admin';
    case USER = 'User';

    /**
     * Returns the label of the given role.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => __('roles.super_admin'),
            self::ADMIN => __('roles.admin'),
            self::USER => __('roles.user'),
        };
    }

    /**
     * Get all roles as a key-value pair of `[value => label]`.
     *
     * @return array<string, string>
     */
    public static function labeled(): array
    {
        return array_combine(
            self::values(),
            array_map(
                fn(self $role) => $role->label(),
                self::cases()
            )
        );
    }
}
