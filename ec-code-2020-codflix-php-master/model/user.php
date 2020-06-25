<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;		
  protected $keyEmail;
  protected $emailVerified;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );

      if ($user->keyEmail) $this->setKeyEmail($user->keyEmail);
      if ($user->emailVerified) $this->setEmailVerified($user->emailVerified);
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    $this->password = $password;
  }

  public function setKeyEmail(string $keyEmail): void {
    $this->keyEmail = $keyEmail;
  }

  public function setEmailVerified(string $emailVerified): void {
    $this->emailVerified = $emailVerified;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getEmailVerified(): string {
    return $this->emailVerified;
  }	

  public function getKeyEmail(): string {
    return $this->keyEmail;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

 /*  $db   = init_db();
    			// Check if email already exist
			$email = $this->getEmail();
      $pas = $this->getPassword();
			$userByEmail = $this->getUserByEmail();
			if ($userByEmail) {
				throw new Exception("Email déjà utilisé");
      }
      
    // Open database connection


    $req  = $db->prepare( "INSERT INTO user ( email, password, keyEmail, emailVerified ) VALUES ( :email, :password, :keyEmail, :emailVerified )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword(),
      'keyEmail'  => null,
      'emailVerified'  => null
    ));

    $this->sendConfirmationEmail($db, $email);


    // Close databse connection
    $db = null;

  } */

  // Open database connection
 $db   = init_db();

 // Check if email already exist
 $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
 $req->execute( array( $this->getEmail() ) );

 if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

 // Insert new user
 $req->closeCursor();

 $email = $this->getEmail();
 //echo $this->getPassword();
 $req  = $db->prepare( "INSERT INTO user ( email, password, keyEmail, emailVerified ) VALUES ( :email, :password, :keyEmail, :emailVerified)" );
 $req->execute( array(
   'email'     => $this->getEmail(),
   'password'  => $this->getPassword(),
   'keyEmail' => null,
   'emailVerified' => null
 ));

 // Close databse connection
 $db = null;
  } 

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail($email = null) {

    var_dump($email);
    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    if (!$email) {
      $email = $this->getEmail();
    }
    $req->execute( array( $this->getEmail() ));

    var_dump("ici");
    var_dump($this->getEmail());
    // Close databse connection
    $db   = null;

    return $req->fetch();
  }


  public function sendConfirmationEmail(PDO $db, string $email) {
    // Create the confirm key
    $keyEmail = md5(microtime(TRUE) * 100000);
    // Update keyEmail of the user
    $req = $db->prepare("UPDATE user SET keyEmail=:keyEmail WHERE email=:email");
    $req->execute([
      'keyEmail' => $keyEmail,
      'email' => $email
    ]);

    // Prepare email for link activation
    $to = $email;
    $subject = "Activer votre compte";
    $header = "From: inscription@votresite.com";

    // The link is compose with keyEmail
    $message = 'Bienvenue sur VotreSite,
     
    Pour activer votre compte, veuillez cliquer sur le lien ci-dessous
    ou copier/coller dans votre navigateur Internet.
     
    http://localhost:8888/ec-code-2020-codflix-php/activation.php?email=' . urlencode($email) . '&keyEmail=' . urlencode($keyEmail) . '
     
     
    ---------------
    Ceci est un mail automatique, Merci de ne pas y répondre.';
    mail($to, $subject, $message, $header); // Envoi du mail

  }


}
