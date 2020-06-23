<?php

require_once('model/user.php');
require_once('model/database.php');

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/
if(isset($_POST['Valider'])){
  singnup();
}

function singnup(){

  // session_start();
    
  // if one session is open
  // if(isset($_SESSION['id'])){

  //   exit;
  // }

   // Verification of value on form

   if(!empty($_POST)){
    extract($_POST);
    $valid = true;

  // Setup value 
    if(isset($_POST['Valider'])){
      $email = htmlentities(strtolower($email));
      $password = htmlentities(trim($password));
      $password_confirm = htmlentities(trim($password_confirm));

      // Verification email
      if(empty($email)){
        $valid = false;
        $error_msg = "Le mail ne peut pas être vide";
      }
      elseif(!preg_match("/^([a-z0-9+-]+)(.[a-z0-9+_-]+)@([a-z0-9-]+.)+[a-z]{2,6}$/ix", $email)){
        $valid = false;
        $error_msg = "Le mail n'est pas valide";
      }
    }
    // Verification password
    if(empty($password)) {
      $valid = false;
      $error_msg = "Le mot de passe ne peut pas être vide";
       }
       elseif($password != $password_confirm)
       {
         $valid = false;
         $error_msg = "La confirmation du mot de passe ne correspond pas";
    }
    //Set value to create user
    if($valid){
      $password = hash('sha256', $password);
      $new_user = new User();
      $new_user->setEmail($email);
      $new_user->setPassword($password);
      $new_user->createUser();

      }
    }
  }