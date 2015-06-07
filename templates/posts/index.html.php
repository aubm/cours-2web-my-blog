<?php include (TEMPLATES_DIR . '/partials/menu.html.php'); ?>

<div class="page-content">
    <div class="container">
        <div class="articles-list">
            <div class="row">
                <?php foreach ($posts as $post) : ?>
                    <div class="col-sm-4">
                        <article class="article-card">
                            <div class="thumbnail">
                                <div class="image-wrapper">
                                    <img src="<?= SERVER_ROOT ?>/images/thumbnails/<?php echo $post->getIllustrationPreview(); ?>"/>
                                </div>
                                <div class="caption">
                                    <h3><?php echo $post->getTitle(); ?></h3>

                                    <p><?php echo $post->getContentShort(); ?> ...</p>

                                    <p>
                                        <a href="<?= SERVER_ROOT ?>/post_details?postSlug=<?= $post->getSlug() ?>"
                                           class="btn btn-primary" role="button">Lire la suite</a>
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>