<?php include (TEMPLATES_DIR . '/partials/menu.html.php'); ?>

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
