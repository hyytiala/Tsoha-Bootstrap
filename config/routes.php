<?php

  $routes->get('/', function() {
    Redirect::to('/tarkastele');
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });


  //Asiakas
  $routes->get('/asiakas', function() {
    AsiakkaatController::index();
  });

  $routes->get('/asiakas/uusi', function() {
    AsiakkaatController::create();
  });

  $routes->post('/asiakas', function(){
    AsiakkaatController::store();
  });

  $routes->get('/asiakas/:id', function($id) {
    AsiakkaatController::show($id);
  });

  $routes->get('/asiakas/:id/edit', function($id){
    AsiakkaatController::edit($id);
  });
  $routes->post('/asiakas/:id/edit', function($id){
    AsiakkaatController::update($id);
  });

  $routes->post('/asiakas/:id/destroy', function($id){
    AsiakkaatController::destroy($id);
  });

  //Kohde

  $routes->get('/kohde', function() {
    KohteetController::index();
  });

  $routes->get('/kohde/uusi', function() {
    KohteetController::create();
  });

  $routes->post('/kohde', function(){
    KohteetController::store();
  });

  $routes->get('/kohde/:id', function($id) {
    KohteetController::show($id);
  });

  $routes->get('/tarkastele/:id', function($id) {
    KohteetController::tarkastele($id);
  });

  //Tyomies
  $routes->get('/tyomies', function() {
    TyomiesController::index();
  });

  $routes->get('/tyomies/uusi', function() {
    TyomiesController::create();
  });

  $routes->post('/tyomies', function(){
    TyomiesController::store();
  });

  //merkinta
  $routes->get('/merkinta/:id', function($id) {
    MerkintaController::create($id);
  });

  $routes->post('/merkinta', function(){
    MerkintaController::store();
  });

//login
  $routes->get('/tarkastele', function(){
    UserController::katselu();
  });
  $routes->post('/tarkastele', function(){
   UserController::handle_katselu();
  });
  $routes->get('/login', function(){
  UserController::login();
  });
  $routes->post('/login', function(){
  UserController::handle_login();
  });
  $routes->post('/logout', function(){
  UserController::logout();
  });

