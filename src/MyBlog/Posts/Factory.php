<?php

namespace MyBlog\Posts;

use MyBlog\Database\Database;
use MyBlog\Http\Request;

class Factory
{
    private static $posts_manager;

    /**
     * @return PostsManagerInterface
     */
    public static function getPostsManager()
    {
        if (null === self::$posts_manager) {
            $db = Database::getInstance();
            $request = new Request();
            $original_images_dir = __DIR__ . '/../../../public/images/originals';
            $preview_images_dir = __DIR__ . '/../../../public/images/thumbnails';
            self::$posts_manager = new PostsManagerMySql($db, $request, $original_images_dir, $preview_images_dir);
        }

        return self::$posts_manager;
    }
}