<?php


namespace App\Helpers;


class RolePermission
{

    const ALL_PERMISSIONS = array("View Admin Dashboard", "Administer Users");
    const CONTENT_MANAGER_PERMISSIONS = array(self::ALL_PERMISSIONS[0]);
    const USER_PERMISSIONS = [];

    const ADMIN_ROLE = "Admin";
    const CONTENT_MANAGER_ROLE = "Content Manager";
    const USER_ROLE = "User";

    const ROLE_PERMISSION = array(
        array(
            'role' => self::ADMIN_ROLE,
            'permissions' => self::ALL_PERMISSIONS
        ),
        array(
            'role' => self::CONTENT_MANAGER_ROLE,
            'permissions' => self::CONTENT_MANAGER_PERMISSIONS
        ),
        array(
            'role' => self::USER_ROLE,
            'permissions' => self::USER_PERMISSIONS
        )
    );
}
