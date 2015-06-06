<?php

use MyBlog\Authentication\Factory;
use MyBlog\Authentication\User;
use MyBlog\Navigation\NavigationHelper;
use MyBlog\Validation\ValidationErrors;
use MyBlog\Validation\ValidationException;

include(__DIR__ . '/../bootstrap.php');

$validation_errors = new ValidationErrors();
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $users_manager = Factory::getUsersManager();
    $user = $users_manager->createUser([
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'password_confirmation' => $_POST['password_confirmation']
    ]);
    try {
        $users_manager->validate($user);
        $users_manager->save($user);

        $navigation_helper = new NavigationHelper();
        $navigation_helper->redirectUser('login.php');
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
                <li><a href="<?= SERVER_ROOT ?>/index.php">Accueil</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-content">
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisation</label>
                <?php foreach ($validation_errors->getErrorsForField('username') as $error_message): ?>
                    <p class="text-danger"><?= $error_message ?></p>
                <?php endforeach; ?>
                <input type="text" id="username" name="username" class="form-control"
                       value="<?= $user->getUsername() ?>"/>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <?php foreach ($validation_errors->getErrorsForField('password') as $error_message): ?>
                    <p class="text-danger"><?= $error_message ?></p>
                <?php endforeach; ?>
                <input type="password" id="password" name="password" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmation du mot de passe</label>
                <?php foreach ($validation_errors->getErrorsForField('password_confirmation') as $error_message): ?>
                    <p class="text-danger"><?= $error_message ?></p>
                <?php endforeach; ?>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Créer un compte</button>
            </div>
            <div>
                <p>Vous avez déjà un compte ? <a href="<?= SERVER_ROOT ?>/login.php">Connectez vous.</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
