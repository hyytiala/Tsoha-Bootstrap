<?php
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('login.html');
    }

    public static function sandbox(){
    $esa = new Asiakas(array(
    'nimi' => 'esa',
    'osoite' => 'tölikkä',
    'postinumero' => '005540',
    'postipaikka' => 'hel',
    'puhelin' => '04055',
    'email' => 'otto@fi'
  ));

  $errors = $esa->errors();

  Kint::dump($errors);
    }

    public static function kohteet(){
      View::make('suunnitelmat/kohde_list.html');
    }

    public static function kohde(){
      View::make('suunnitelmat/kohde_view.html');
    }

    public static function muokkaa(){
      View::make('suunnitelmat/muokkaa_kohdetta.html');
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

    public static function asiakasmuok(){
      View::make('suunnitelmat/asiakasmuok.html');
    }

    public static function asiakkaat(){
      View::make('suunnitelmat/asiakas_list.html');
    }

    public static function tyomiehet(){
      View::make('suunnitelmat/tyomies_list.html');
    }

    public static function tyomiesmuok(){
      View::make('suunnitelmat/tyomiesmuok.html');
    }
  }
