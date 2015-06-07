<?php include (TEMPLATES_DIR . '/partials/menu-admin.html.php'); ?>

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
