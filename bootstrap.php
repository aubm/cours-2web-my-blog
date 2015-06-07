<?php

/* Ce fichier contient du code destiné à être éxécuté en début de script. C'est la
   raison pour laquelle les fichiers sous la racine du serveur HTTP (ei: le répertoire
   public) l'incluent avant toute autre instruction.
   Son rôle est de définir certains comportements globaux du script. */

/* Il commence par appeler session_start() afin de permettre à PHP de persister des
   données en session, en écrivant directement dans la superglobale $_SESSION. */
session_start();

/* Il définit la constante SERVER_ROOT dont la valeur représentera le chemin complet
   vers le script en cours d'éxécution depuis le document root du serveur. Si par exemple
   le blog est stocké dans /www/my_projects/my_blog et que l'utilisateur accède au script
   my_blog/public/index.php, alors SERVER_ROOT vaudra /my_projects/my_blog/public à supposer
   dans ce cas que le répertoire www est le document root du serveur (apache par exemple).

   Si le document root du serveur est configuré sur le répertoire public, alors pour le même
   exemple, SERVER_ROOT sera une chaîne de caractères vide. Sa valeur est appelée pour préfixer
   l'ensemble des liens faisant références à des ressources du site. */
$server_root = dirname($_SERVER['SCRIPT_NAME']);
$server_root = ($server_root !== '/' && $server_root !== '\\') ? $server_root : '';
define('SERVER_ROOT', $server_root);

/* Il définit la constante TEMPLATES_DIR qui contient le chemin système vers le répertoire
   sous lequel sous stockés les fichiers templates */
define('TEMPLATES_DIR', __DIR__ . '/templates');

/* Il définit le comportement du chargement automatique des classes et des interfaces pour le site.
   Cette configuration repose sur les conventions suivantes :
       - l'espace de nommage d'une classe doit correspondre au chemin vers le fichier où est définie cette classe,
         sous le répertoire src. La classe \MyBlog\Posts\PostsManager devra donc être définie dans
         un fichier du répertoire src/MyBlog/Posts.
       - le nom du fichier dans lequel est défini la classe doit correspondre au nom de cette classe
         et porter l'extension php. La classe PostsManager devra donc être définie dans le fichier
         PostsManager.php
   Ce modèle d'auto-chargement des classes reposant sur la fonctionnalité d'espace de nommage a été
   approuvé comme standard par la communauté PHP sous la rfc PSR-0.
   https://github.com/php-fig/fig-standards/blob/master/accepted/fr/PSR-0.md
   D'autres standards existent (PSR-1, PSR-2, etc ...) et visent à uniformiser la manière dont les programmeurs
   PHP écrivent leur code. Ils s'adressent tout particulièrement aux développeurs de frameworks et
   de libraries, afin de faciliter l'adoption et l'intégration de leurs produits dans des projets
   existant. */
spl_autoload_register(function ($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    include (__DIR__ . '/src/' . $class_name . '.php');
});