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
      $_SESSION['admin'] = $kayttaja->admin;
      Redirect::to('/kohde', array('message' => 'Tervetuloa  ' . $kayttaja->nimi . '!'));
    }
  }

  public static function logout(){
    $_SESSION['kayttaja'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
  }

  public static function katselu(){
    View::make('kayttaja/tarkastele.html');
  }

  public static function handle_katselu(){
    $params = $_POST;
    $id = $params['id'];
    Redirect::to('/tarkastele/' . $id);
  }

  public static function edit_password($id){
        $kayttaja = Kayttaja::find($id);
        View::make('kayttaja/salasana.html', array('attributes' => $kayttaja));
    }

  public static function update_password($id){
    $params = $_POST;
    $attributes = array(
      'id' => $id,
      'salasana' => $params['salasana']
      );

    $kayttaja = new Kayttaja($attributes);
    $errors = array();
    $errors[] = 'Salasanat eivät täsmää';

    if(Kayttaja::authenticate_password($params['nyk'], $id) && $params['salasana'] == $params['re']){
      $kayttaja->update_password();
      Redirect::to('/tyomies', array('message' => 'Salasana on päivitetty'));
    }else{
      View::make('kayttaja/salasana.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }

  public static function reset_password($id){
    self::check_logged_in();
    $kayttaja = new Kayttaja(array('id' => $id));
    $kayttaja->reset_password();
    Redirect::to('/tyomies', array('message' => 'Salasana nollattu: salasana'));
  }
}