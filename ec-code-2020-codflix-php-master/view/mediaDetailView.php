<?php ob_start();?>
<?php
    
    $id_media = $_GET['media'];
    
    $req = Media::detailMedia($id_media);
    $reqGenre = Media::detailMediaGenre($id_media);

    // echo $reqGenre['name'];
    // echo $req['name'];
    //var_dump($req[1]);
    // echo $req['title'];
    // echo $req['type'];
    // echo $req['status'];
    // echo $req['release_date'];
    // echo $req['summary'];
    echo $req['trailer_url'];

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
            <span id="media_genre" class="row">Type : <?= $req['type']?> ; Status : <?= $req['status']?></span>
            <p class="row">Date de réalisation: <?= $req['release_date']?></p>
            <p class="row">Durée : <?= $req['duration']?></p>
        </div>
        <span>Sommaire : <?= $req['summary']?></span>
        <p></p>
    </div>
    <div class="row video mt-4">

            <iframe width="560" height="315" src="<?= $req['trailer_url']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    
</div>


<?php $content = ob_get_clean(); ?>

<?php require( 'dashboard.php'); ?>