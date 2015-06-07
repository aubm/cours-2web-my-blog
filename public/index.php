<?php

include(__DIR__ . '/../bootstrap.php');

use MyBlog\App;

$app = new App();
$app->initRouterWithConfig(json_decode(file_get_contents(__DIR__ . '/../routes.json'), true));
$app->handleRequest();
