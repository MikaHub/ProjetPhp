<?php 

require_once( 'model/user.php' );
require_once( 'loginController.php' );

function profilPage() {

    $user_id = $_SESSION['user_id'];

    if($user_id){
        $req = User::getUserById($user_id);

        if(isset($_POST['ValiderProfil'])){
            updateAccount($user_id);
   
        }
        elseif(isset($_POST['Delete'])){
            deleteAccount($user_id);
        }
        require('view/profilView.php');

    }else{
        require_once('view/homeView.php');
    }
}

function updateAccount( $user_id) {
    
    $email = $_POST['email'];
    
    $password = hash('sha256', $_POST['password']); // Hash input password to compare with the hashed password within DB.
    
    $newPassword = $_POST['newPassword'];

    $newPasswordConfirm = $_POST['new_password_confirm'];
    
    $user = new User();
    $userData = $user->getUserById($user_id); // Get the current user's data in order to compare the inputs with the current data.

    // The current password is required to save new data.
    if ($password != $userData['password']) {
        $error_msg = "Le mot de passe actuel est erroné.";
    }        
    elseif (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email))
    {
      $error_msg = "Format de mail non valide.";
    }
    elseif (strlen($newPassword) < 6)
    {
        $error_msg = "Nouveau mot de passe incorrect. Min. 6 caractères.";
    }
    elseif ($newPassword != $newPasswordConfirm)
    {
        $error_msg = "Les nouveaux mots de passe ne correspondent pas.";
    }
    else
    {
        $user->setId($user_id);
        $user->setEmail($email);
        $user->setPassword($newPassword);

        $userData = $user->getUserByEmail();

        if ($userData && sizeof( $userData ) > 0) // If email address is already in used, show error.
        {
            $error_msg = "Cette adresse mail est déjà utilisée.";
        }
        else
        {
            $user->updateUser();
            $success_msg = "Vos informations ont été modifiées avec succès.";
        }       
    }

    require('view/profilView.php');
}

function deleteAccount($user_id){

    $user_id = $_SESSION['user_id'];
    $password = hash('sha256', $_POST['password']);

    $user = new User();
    $userData = $user->getUserById($user_id); // Get the current user's data in order to compare the inputs with the current data.

    // The current password is required to save new data.
    if ($password != $userData['password']) {
        $error_msg = "Le mot de passe actuel est erroné.";
    }
    else{
        $user->setId($user_id);
        $user->deleteUser();
        logOut(); // Logging out the current user once the account has been successfully deleted.
    }

    require('view/profilView.php');
}


?>
