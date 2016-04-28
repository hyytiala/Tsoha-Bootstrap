<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['kayttaja'])){
      $kayttaja_id = $_SESSION['kayttaja'];
      // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
      $kayttaja = Kayttaja::find($kayttaja_id);

      return $kayttaja;
      }

    // Käyttäjä ei ole kirjautunut sisään
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['kayttaja'])){
        Redirect::to('/login', array('message' => 'Kirjaudu sisään!'));
      }
    }

    public static function get_admin(){
      if($_SESSION['admin'] == 1){
      $kayttaja_id = $_SESSION['kayttaja'];
      $kayttaja = Kayttaja::find($kayttaja_id);

      return $kayttaja;
      }

      return null;
    }

    public static function check_admin(){
      if(!isset($_SESSION['kayttaja'])){
        Redirect::to('/login', array('message' => 'Kirjaudu sisään!'));
      }
    }

  }
