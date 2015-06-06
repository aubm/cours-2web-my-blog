<?php

session_start();

$server_root = dirname($_SERVER['SCRIPT_NAME']);
$server_root = ($server_root !== '/' && $server_root !== '\\') ? $server_root : '';
define('SERVER_ROOT', $server_root);

spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    include (__DIR__ . '/src/' . $class_name . '.php');
});