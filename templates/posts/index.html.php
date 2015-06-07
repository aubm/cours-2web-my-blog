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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#main-menu-collapse">
                <span class="sr-only">Activer la navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?= SERVER_ROOT ?>/" class="navbar-brand">Mon blog</a>
        </div>
        <div class="collapse navbar-collapse" id="main-menu-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= SERVER_ROOT ?>/">Accueil</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-content">
    <div class="container">
        <div class="articles-list">
            <div class="row">
                <?php foreach ($posts as $post) : ?>
                    <div class="col-sm-4">
                        <article class="article-card">
                            <div class="thumbnail">
                                <div class="image-wrapper">
                                    <img src="<?= SERVER_ROOT ?>/images/thumbnails/<?php echo $post->getIllustrationPreview(); ?>"/>
                                </div>
                                <div class="caption">
                                    <h3><?php echo $post->getTitle(); ?></h3>

                                    <p><?php echo $post->getContentShort(); ?> ...</p>

                                    <p>
                                        <a href="<?= SERVER_ROOT ?>/post_details?postSlug=<?= $post->getSlug() ?>"
                                           class="btn btn-primary" role="button">Lire la suite</a>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
