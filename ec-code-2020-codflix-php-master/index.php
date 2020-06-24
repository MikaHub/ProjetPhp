<?php

require_once( 'controller/homeController.php' );
require_once( 'controller/loginController.php' );
require_once( 'controller/signupController.php' );
require_once( 'controller/mediaController.php' );
require_once( 'controller/mediaDetailController.php' );
require_once( 'controller/contactController.php' );
require_once( 'controller/profilController.php' );

/**************************
* ----- HANDLE ACTION -----
***************************/

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;

if ( isset( $_GET['action'] ) ):

  switch( $_GET['action']):

    case 'login':
      if($user_id){
        mediaPage();
      }else{
        if ( !empty( $_POST ) ) login( $_POST );
        else loginPage();
      }

    break;

    case 'signup':
      if($user_id){
        mediaPage();
      }else{
        signupPage();
      }

    break;

    case 'logout':

      logout();

    break;

    //go to film page
    case 1:

      mediaDetailPage();

    break;  

    // go to serie page to have episode and saison
    case 2:

      mediaDetailSeriePage();
    
    break;

    case 'contact';

      contact();

    break;

    case 'profil';

      profilPage();

    break;  

  endswitch;

else:

  $user_id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( $user_id ):
    mediaPage();
  else:
    homePage();
  endif;

endif;
