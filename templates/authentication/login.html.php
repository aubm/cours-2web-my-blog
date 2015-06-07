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
                <li><a href="<?= SERVER_ROOT ?>/">Accueil</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="page-content">
    <div class="container">
        <form method="post">
            <?php if ($error): ?>
                <p class="text-danger">
                    <?= $error ?>
                </p>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Nom d'utilisation</label>
                <input type="text" id="username" name="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
            <div>
                <p>Vous n'avez pas encore de compte ? <a href="<?= SERVER_ROOT ?>/register">Enregistrez vous.</a>
                </p>
            </div>
        </form>
    </div>
</div>
</body>
</html>
