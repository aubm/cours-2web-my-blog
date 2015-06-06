<?php

include ('../bootstrap.php');

use MyBlog\Authentication\Factory;
use MyBlog\Navigation\NavigationHelper;

$authentication_helper = Factory::getAuthenticationHelper();
$authentication_helper->unsetCurrentUser();

$navigation_helper = new NavigationHelper();
$navigation_helper->redirectUser('index.php');