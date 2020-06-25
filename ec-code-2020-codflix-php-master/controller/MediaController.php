<?php

require_once( 'model/media.php' );
/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::getAllMedias($search);

  $genre = isset( $_GET['name'] ) ? $_GET['name'] : null;
  $type = Media::detailMediaGenre($genre);
  
  $media = isset( $_GET['media'] ) ? $_GET['media'] : null;
  $addMedia = Media::addMedia($user_id, $media);

  $visitedMedias = Media::visitedMedias($user_id);

  require('view/mediaListView.php');

}
