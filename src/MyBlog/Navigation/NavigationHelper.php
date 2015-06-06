<?php

namespace MyBlog\Navigation;

class NavigationHelper
{
    public function redirectUser($location)
    {
        header("Location: $location");
        exit();
    }
}