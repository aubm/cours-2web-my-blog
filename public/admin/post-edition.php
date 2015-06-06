<?php

include(__DIR__ . '/../../bootstrap.php');

use \MyBlog\Posts\Factory;
use MyBlog\Posts\Post;
use MyBlog\Navigation\NavigationHelper;
use MyBlog\Http\Request;
use MyBlog\Validation\ValidationErrors;
use MyBlog\Validation\ValidationException;

include (__DIR__ . '/check-user-authentication.php');

/* Les variables $validation_errors et $post sont utilisées dans le template
   qu'il s'agisse d'une requête de type GET ou de type POST.

   L'objet $validation_errors est utilisé pour extraire les erreurs potentielles
   associées aux champs du formulaire.

   L'état de $post est utilisé pour pré-remplir les champs du formulaire
   (voir notamment les attributs value des champs input). */
$validation_errors = new ValidationErrors();
$post = new Post();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = new Request();
    $posts_manager = Factory::getPostsManager();

    /* $post contient une instance de \MyBlog\Posts\Post dont l'état
       est issu des informations contenues dans le corps de la
       requête HTTP (ei: $_POST) */
    $post = $posts_manager->createNewPost([
        'title' => $_POST['title'],
        'slug' => $_POST['slug'],
        'content' => $_POST['content'],
        'content_short' => $_POST['content_short'],
        'uploaded_files' => $request->getRequestFilesFromGlobals()
    ]);

    try {
        /* PostsManagerInterface::validate() lévera une exception du type
           \MyBlog\Validation\ValidationException si des erreurs de validation
           existent.
           Cette exception sera catchée par le bloc catch, dans lequel
           l'instance de \MyBlog\Validation\ValidationErrors sera extraite (afin
           d'être utilisée dans le template).
           Si aucune exception n'est levée, les instructions suivantes du bloc
           try seront executées. Ainsi le post sera sauvegardé, puis l'utilisateur
           sera redirigé vers l'accueil de l'espace d'administration. */
        $posts_manager->validate($post);
        $posts_manager->save($post);
        $navigation_helper = new NavigationHelper();
        $navigation_helper->redirectUser('index.php');
    } catch (ValidationException $e) {
        $validation_errors = $e->getValidationErrors();
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link href="<?= SERVER_ROOT ?>/../dist/app.min.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?= SERVER_ROOT ?>/../dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?= SERVER_ROOT ?>/../dist/bootstrap.min.js"></script>
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
            <a href="<?= SERVER_ROOT ?>/" class="navbar-brand">Mon blog - Administration</a>
        </div>
        <div class="collapse navbar-collapse" id="main-menu-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?= SERVER_ROOT ?>/">Administration</a></li>
                <li class="active"><a href="<?= SERVER_ROOT ?>/post-edition.php">Ajouter un article</a></li>
                <li><a href="<?= SERVER_ROOT ?>/../">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-content">
    <div class="container">
        <h1>Modification d'un article</h1>

        <form enctype="multipart/form-data" method="post">
            <fieldset>
                <legend>Méta-données</legend>
                <div class="form-group">
                    <label for="title">Titre</label>
                    <?php foreach ($validation_errors->getErrorsForField('title') as $error_message): ?>
                        <p class="text-danger"><?= $error_message ?></p>
                    <?php endforeach; ?>
                    <input type="text" name="title" id="title" class="form-control" value="<?= $post->getTitle() ?>"/>
                </div>
                <div class="form-group">
                    <label for="slug">Alias</label>
                    <?php foreach ($validation_errors->getErrorsForField('slug') as $error_message): ?>
                        <p class="text-danger"><?= $error_message ?></p>
                    <?php endforeach; ?>
                    <input type="text" name="slug" id="slug" class="form-control" value="<?= $post->getSlug() ?>"/>
                </div>
            </fieldset>
            <fieldset>
                <legend>Médias</legend>
                <div class="form-group">
                    <label for="illustration_original">Illustration</label>
                    <?php foreach ($validation_errors->getErrorsForField('illustration_original') as $error_message): ?>
                        <p class="text-danger"><?= $error_message ?></p>
                    <?php endforeach; ?>
                    <input type="file" name="illustration_original" id="illustration_original"/>
                </div>
                <div class="form-group">
                    <label for="illustration_preview">Prévisualisation de l'illustration</label>
                    <?php foreach ($validation_errors->getErrorsForField('illustration_preview') as $error_message): ?>
                        <p class="text-danger"><?= $error_message ?></p>
                    <?php endforeach; ?>
                    <input type="file" name="illustration_preview" id="illustration_preview"/>
                </div>
            </fieldset>
            <fieldset>
                <legend>Contenu</legend>
                <div class="form-group">
                    <label for="content_short">Contenu (version courte)</label>
                    <?php foreach ($validation_errors->getErrorsForField('content_short') as $error_message): ?>
                        <p class="text-danger"><?= $error_message ?></p>
                    <?php endforeach; ?>
                    <textarea id="content_short" name="content_short" class="form-control"><?= $post->getContentShort() ?></textarea>
                </div>
                <div class="form-group">
                    <label for="content">Contenu</label>
                    <?php foreach ($validation_errors->getErrorsForField('content') as $error_message): ?>
                        <p class="text-danger"><?= $error_message ?></p>
                    <?php endforeach; ?>
                    <textarea id="content" name="content" class="form-control"><?= $post->getContent() ?></textarea>
                </div>
            </fieldset>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
