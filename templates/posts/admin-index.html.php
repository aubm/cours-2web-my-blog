<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="<?= SERVER_ROOT ?>/dist/app.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?= SERVER_ROOT ?>/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?= SERVER_ROOT ?>/dist/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= SERVER_ROOT ?>/javascripts/remove-post.jquery.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top main-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#main-menu-collapse">
                <span class="sr-only">Activer la navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="<?= SERVER_ROOT ?>/admin" class="navbar-brand">Mon blog - Administration</a>
        </div>
        <div class="collapse navbar-collapse" id="main-menu-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= SERVER_ROOT ?>/admin">Administration</a></li>
                <li><a href="<?= SERVER_ROOT ?>/admin/edit_post">Ajouter un article</a></li>
                <li><a href="<?= SERVER_ROOT ?>/logout">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-content">
    <div class="container">
        <table class="table table-condensed table-hover table-vertical-center">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Alias</th>
                <th>Contenu</th>
                <th>Date de publication</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="posts-container">
            <?php foreach ($posts as $post) : ?>
                <tr id="post-<?= $post->getId() ?>">
                    <td><?= $post->getTitle() ?></td>
                    <td><?= $post->getSlug() ?></td>
                    <td><?= $post->getContentShort() ?> ...</td>
                    <td><?= $post->getPublishedAt() ?></td>
                    <td>
                        <button class="btn btn-danger remove-button" data-post-id="<?= $post->getId() ?>">
                            Supprimer
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
