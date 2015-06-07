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
