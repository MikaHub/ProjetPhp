<?php

require_once( 'database.php' );

class Media {

  protected $id;
  protected $genre_id;
  protected $title;
  protected $type;
  protected $status;
  protected $release_date;
  protected $summary;
  protected $trailer_url;
  protected $typeOf;
  protected $saison;
  protected $episode1;
  protected $episode2;
  protected $episode3;

  public function __construct( $media ) {

    $this->setId( isset( $media->id ) ? $media->id : null );
    $this->setGenreId( $media->genre_id );
    $this->setTitle( $media->title );
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setGenreId( $genre_id ) {
    $this->genre_id = $genre_id;
  }

  public function setTitle( $title ) {
    $this->title = $title;
  }

  public function setType( $typeof ) {
    $this->typeof = $typeof;
  }

  public function setStatus( $status ) {
    $this->status = $status;
  }

  public function setReleaseDate( $release_date ) {
    $this->release_date = $release_date;
  }
  public function setSaison( $saison ) {
    $this->saison = $saison;
  } 
  public function setEpisode1( $episode1 ) {
    $this->episode1 = $episode1;
  }
  public function setEpisode2( $episode2 ) {
    $this->episode2 = $episode2;
  }
  public function setEpisode3( $episode3) {
    $this->episode3 = $episode3;
  }


  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getGenreId() {
    return $this->genre_id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getType() {
    return $this->typeOf;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getReleaseDate() {
    return $this->release_date;
  }

  public function getSummary() {
    return $this->summary;
  }

  public function getTrailerUrl() {
    return $this->trailer_url;
  }

  public function getSaison() {
    return $this->saison;
  } 
  public function getEpisode1() {
    return $this->episode1;
  }
  public function getEpisode2() {
    return $this->episode2;
  }
  public function getEpisode3() {
    return $this->episode3;
  }


  /***************************
  * -------- GET LIST --------
  ***************************/

  public static function filterMedias( $title ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM media WHERE title = ? ORDER BY release_date DESC" );
    $req->execute( array( '%' . $title . '%' ));

    // Close databse connection
    $db   = null;

    return $req->fetchAll();

  }

  public static function getAllMedias($search) {

    $db = init_db();

    if(empty($search)){
      $req = $db->prepare( "SELECT * FROM media" );
      $req->execute();

      $db = null;

      return $req->fetchAll();

    }else{
      $req = $db->prepare( 'SELECT * FROM media WHERE title LIKE "%'.$search.'%"' );
      $req->execute();

      $db = null;

      return $req->fetchAll();

    }

  }

  public static function detailMedia($id_media ){

    $db = init_db();

    $req = $db->prepare( "SELECT * FROM media WHERE id = " . $id_media );
    $req->execute();


    $db = null;

    return $req->fetch();
  }
  public static function detailMediaGenre($genre ){

    $db = init_db();

    $req = $db->prepare( "SELECT * FROM `genre` WHERE id = ". $genre);
    $req->execute();


    $db = null;

    return $req->fetch();
  }

  public static function detailTypeOf($id_media){

    $db = init_db();

    $req = $db->prepare( "SELECT * FROM `type` WHERE id = " . $id_media );
    $req->execute();


    $db = null;

    return $req->fetch();
  }

}
