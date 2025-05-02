<?php

namespace App\Enums\Admin;

use App\Traits\EnumValues;

enum SystemPermissions: string
{
    use EnumValues;

    case VIEW_USERS = 'view users';
    case CREATE_USERS = 'create users';
    case EDIT_USERS = 'edit users';
    case DELETE_USERS = 'delete users';

    /**
     * Returns the label of the given permission.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::VIEW_USERS => __('permissions.view_users'),
            self::CREATE_USERS => __('permissions.create_users'),
            self::EDIT_USERS => __('permissions.edit_users'),
            self::DELETE_USERS => __('permissions.delete_users'),
        };
    }

    /**
     * Get all permissions as a key-value pair of `[value => label]`.
     *
     * @return array<string, string>
     */
    public static function labeled(): array
    {
        return array_combine(
            self::values(),
            array_map(
                fn(self $permission) => $permission->label(),
                self::cases(),
            ),
        );
    }
}
