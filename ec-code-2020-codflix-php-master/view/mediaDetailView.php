<?php ob_start();?>

<?php

    $id_media = $_GET['media'];
    $genre = $_GET['genre'];
    $typeOf = $_GET['action'];
    
    $reqGenre = Media::detailMediaGenre($genre);

    $req = Media::detailMedia($id_media);

    $reqTypeOf = Media::detailTypeOf($typeOf);

?>

<div class="row">
    <div class="col-md-4">
        <h3><?= $req['title']; ?></h3>
    </div>
    <div class="col d-flex justify-content-end">
        <div>
            <a href="index.php" class="btn btn-dark">X</a>
        </div>
    </div>
</div>

<div class="col mt-5">
    <div class="row mt-4">
        <div class="col mt-2">
            <span id="media_genre" class="row">Genre : <?= $reqGenre['name']?></span>
            <span id="media_genre" class="row">Type : <?= $reqTypeOf['name']?> ; Status : <?= $req['status']?></span>
            <p class="row">Date de réalisation: <?= $req['release_date']?></p>
            <p class="row">Durée : <?= $req['duration']?></p>
        </div>
        
        <span>Sommaire : <?= $req['summary']; ?></span>
        <p></p>
    </div>
    <div class="row video mt-4">

            <iframe width="560" height="315" src="<?= $req['trailer_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    
</div>


<?php $content = ob_get_clean(); ?>

<?php require( 'dashboard.php'); ?>