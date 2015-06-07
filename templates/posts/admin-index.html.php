<script type="text/javascript" src="<?= SERVER_ROOT ?>/javascripts/remove-post.jquery.js"></script>

<?php include (TEMPLATES_DIR . '/partials/menu-admin.html.php'); ?>

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
