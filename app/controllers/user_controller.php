<?php

class UserController extends BaseController{
  public static function login(){
      View::make('kayttaja/login.html');
  }
  public static function handle_login(){
    $params = $_POST;
    $kayttaja = Kayttaja::authenticate($params['kayttaja'], $params['salasana']);

    if(!$kayttaja){
      View::make('kayttaja/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttaja' => $params['kayttaja']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;
      Redirect::to('/asiakas', array('message' => 'Tervetuloa  ' . $kayttaja->nimi . '!'));
    }
  }
}