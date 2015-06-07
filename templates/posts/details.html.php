<?php include (TEMPLATES_DIR . '/partials/menu.html.php'); ?>

<div class="page-content">
    <div class="container">
        <article class="text-justify">
            <header class="details-header-image">
                <img src="<?= SERVER_ROOT ?>/images/originals/<?= $post->getIllustrationOriginal() ?>"
                     class="img-responsive"/>
            </header>
            <h1><?= $post->getTitle() ?></h1>
            <section>
                <p><?= $post->getContent() ?></p>
            </section>
        </article>
    </div>
</div>
