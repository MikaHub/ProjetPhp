<?php

require_once( 'model/media.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function mediaPage() {

  
  $search = isset( $_GET['title'] ) ? $_GET['title'] : null;
  $medias = Media::getAllMedias($search);

  require('view/mediaListView.php');

}

