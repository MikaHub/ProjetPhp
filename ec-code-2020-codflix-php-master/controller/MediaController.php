<?php

require_once( 'model/media.php' );
/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  
  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::getAllMedias($search);

  $genre = isset( $_GET['name'] ) ? $_GET['name'] : null;
  $type = Media::detailMediaGenre($genre);
  
  require('view/mediaListView.php');

}
