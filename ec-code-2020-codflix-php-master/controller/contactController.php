<?php

require_once( 'model/user.php' );

if (isset($_POST['send'])) {
    sendEmail($_POST['send']);
}

function contactPage() {
    $email = isset($_POST['email']);
    $message = isset($_POST['message']);

    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email))
    {
        $error_msg = "Mail non valide";
    }
    elseif (empty($message))
    {
        $error_msg = "Veuillez saisir votre message";
    }
    else
    {
        sendEmail($email, $message);
        $success_msg = "Votre message a bien été envoyé à notre équipe";
    } 

    require('view/auth/contactView.php');
}

function sendEmail( $post ) {

     $to      = 'contact@codflix.com';
     $message = $_POST['message'];
     $headers = 'From ' . $_POST['email'] . "\r\n" . $_POST['name'];

     mail($to, $message, $headers);
}

?>