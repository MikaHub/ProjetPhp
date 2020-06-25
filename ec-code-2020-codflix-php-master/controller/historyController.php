<?php 
require_once( 'model/media.php' );

    function historyPage(){

        $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

        $id_media = isset($_GET['media']);

        $addMedia = Media::addMedia($user_id, $id_media);

        $visitedMedias = Media::visitedMedias($user_id);
    
        require_once('view/historyView.php');
    }
?>