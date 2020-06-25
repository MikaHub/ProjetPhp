
<?php ob_start(); ?>



<form method="post" action="index.php?action=history" class="custom-form">
    <div class="row">
        <h1 class="media-header col-md-10">Mes derniers média vu</h1>
    </div>

    <div class="media-list">
        <?php
            if ($visitedMedias):       
            foreach( $visitedMedias as $i):
                $media = Media::detailMedia($i['media_id']);
        ?>
            <a class="item" href="index.php?media=<?= $media['id']; ?>">
                <div class="video">
                    <div>
                        <iframe allowfullscreen="" frameborder="0"
                                src="<?= $media['trailer_url']; ?>" ></iframe>
                    </div>
                </div>
                <div class="title"><?= $media['title']; ?></div>              
                <div class="d-flex justify-content-center"><span class="badge badge-light"><?= substr($media['release_date'], 0, 4) ?></span></div>
            </a>
            
            
        <?php endforeach; else: ?>
        <h3>Aucune consultation récente pour le moment.</h3>
        <?php endif; ?>
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>