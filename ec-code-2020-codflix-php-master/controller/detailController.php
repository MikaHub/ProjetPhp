<?php


function dataOfForm($post){

    $data  = new stdClass();
    $data->saison   = $post['saison'];
    $data->episode   = $post['episode'];

    if(isset($data->saison) && isset($data->episode)){
        
    }
}
?>