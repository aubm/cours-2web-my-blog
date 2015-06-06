<?php

include(__DIR__ . '/../../bootstrap.php');

use MyBlog\Navigation\NavigationHelper;
use MyBlog\Posts\Factory;

include (__DIR__ . '/check-user-authentication.php');

$posts_manager = Factory::getPostsManager();

$post_id = $_POST['post_id'];
$post = $posts_manager->getOnePostById($post_id);

$posts_manager->removePost($post);

$navigation_helper = new NavigationHelper();
$navigation_helper->redirectUser('index.php');