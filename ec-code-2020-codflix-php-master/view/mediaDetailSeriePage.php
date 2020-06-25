<?php ob_start();?>

<?php

    $user_id = $_SESSION['user_id'];

    $id_media = $_GET['media'];
    $genre = $_GET['genre'];
    $typeOf = $_GET['action'];
    
    $reqGenre = Media::detailMediaGenre($genre);
    $req = Media::detailMedia($id_media);

    
    $visitedMedias = Media::visitedMedias($user_id);
    
    $addMedia = Media::addMedia($user_id, $id_media);

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
            <span id="media_genre" class="row">Genre : <?= $reqGenre['name'];?></span>
            <span id="media_genre" class="row">Type : <?= $reqTypeOf['name'];?> ; Status : <?= $req['status']?></span>
            <p class="row">Date de réalisation: <?= $req['release_date'];?></p>
            <p class="row">Durée : <?= $req['duration'];?></p>
        </div>
        <span>Sommaire : <?= $req['summary']?></span>


        <form method="post">
            <select name="saison">
                <option value="">--Please choose an option--</option>
                <option value="saison1">Saison 1</option>
            </select>
            <select name="episode">
                <option value="">--Please choose an option--</option>
                <option value="episode1">Episode 1</option>
                <option value="episode2">Episode 2</option>
            </select>
            <p><input type="submit"></p>

        </form>
        <p></p>
    </div>
    <div class="row video mt-4">

            <?php
            $video1 =  $req['episode1'];
            $video2 =  $req['episode2'];

                if(isset($_POST['saison']) == "saison1" && $_POST['episode'] == "episode1"):
                    echo "<iframe width=\"560\" height=\"315\" src=" . $video1 . " frameborder=\"0\" allowfullscreen></iframe>";
                elseif(isset($_POST['saison']) == "saison1" && $_POST['episode'] == "episode2"):   
                    echo "<iframe width=\"560\" height=\"315\" src=" . $video2 . " frameborder=\"0\" allowfullscreen></iframe>";

                endif; 
            ?>
            

    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require( 'dashboard.php'); ?>