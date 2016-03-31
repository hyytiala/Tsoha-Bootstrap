<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function kohteet(){
      // Testaa koodiasi täällä
      View::make('kohde_list.html');
    }

    public static function kohde(){
      // Testaa koodiasi täällä
      View::make('kohde_view.html');
    }

    public static function muokkaa(){
      // Testaa koodiasi täällä
      View::make('muokkaa_kohdetta.html');
    }

    public static function login(){
      // Testaa koodiasi täällä
      View::make('login.html');
    }
  }
