<?php

namespace MyBlog\Hash;

class Factory
{
    /** @var HasherInterface */
    private static $hasher;

    public static function getHasher()
    {
        if (self::$hasher === null) {
            self::$hasher = new Hasher();
        }
        return self::$hasher;
    }
}