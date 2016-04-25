<?php

class TarkasteluController extends BaseController{
  
  public static function katselu(){
    View::make('kayttaja/tarkastele.html');
  }

  public static function handle_katselu(){
    $params = $_POST;
    $id = $params['id'];
    Redirect::to('/tarkastele/' . $id);
  }
}