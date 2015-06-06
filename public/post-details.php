<?php

include(__DIR__ . '/../bootstrap.php');

use \MyBlog\Posts\Factory;

$posts_manager = Factory::getPostsManager();
/* Le paramètre d'url postSlug peut être directement lu en accédant
   à l'index 'postSlug' de la superglobale $_GET. $_GET, au même titre que
   $_POST, $_REQUEST, $_SERVER, $_SESSION (etc ...) est de type array. */
$post = $posts_manager->getOnePostBySlug($_GET['postSlug']);
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="<?= SERVER_ROOT ?>/dist/app.min.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="<?= SERVER_ROOT ?>/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?= SERVER_ROOT ?>/dist/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top main-navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-collapse">
                        <span class="sr-only">Activer la navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?= SERVER_ROOT ?>/" class="navbar-brand">Mon blog</a>
                </div>
                <div class="collapse navbar-collapse" id="main-menu-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?= SERVER_ROOT ?>/index.php">Accueil</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="page-content">
            <div class="container">
                <article class="text-justify">
                    <header class="details-header-image">
                        <img src="<?= SERVER_ROOT ?>/images/originals/<?= $post->getIllustrationOriginal() ?>" class="img-responsive"/>
                    </header>
                    <h1><?= $post->getTitle() ?></h1>
                    <section>
                        <p><?= $post->getContent() ?></p>
                    </section>
                </article>
            </div>
        </div>
    </body>
</html>
