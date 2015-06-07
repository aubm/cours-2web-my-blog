<?php include (TEMPLATES_DIR . '/partials/menu.html.php'); ?>

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
                <p>Vous avez déjà un compte ? <a href="<?= SERVER_ROOT ?>/login">Connectez vous.</a></p>
            </div>
        </form>
    </div>
</div>
