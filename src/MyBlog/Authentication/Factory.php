<?php

namespace MyBlog\Authentication;

use MyBlog\Database\Database;

class Factory
{
    private static $users_manager;
    private static $authentication_helper;

    /**
     * @return UsersManagerMySql
     */
    public static function getUsersManager()
    {
        if (self::$users_manager === null) {
            $db = Database::getInstance();
            self::$users_manager = new UsersManagerMySql($db);
        }
        return self::$users_manager;
    }

    /**
     * @return AuthenticationHelper
     */
    public static function getAuthenticationHelper()
    {
        if (self::$authentication_helper === null) {
            self::$authentication_helper = new AuthenticationHelper();
        }
        return self::$authentication_helper;
    }
}