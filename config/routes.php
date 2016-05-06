<?php

  //Frontpage
  $routes->get('/', function() {
    if(isset($_SESSION['kayttaja'])){
      Redirect::to('/kohde');
    }else{
      Redirect::to('/tarkastele');
    }
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

  $routes->get('/kohde/:id/edit', function($id){
    KohteetController::edit($id);
  });

  $routes->post('/kohde/:id/edit', function($id){
    KohteetController::update($id);
  });

  $routes->post('/kohde/:id/destroy', function($id){
    KohteetController::destroy($id);
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

  $routes->get('/tyomies/:id/edit', function($id){
    TyomiesController::edit($id);
  });

  $routes->post('/tyomies/:id/edit', function($id){
    TyomiesController::update($id);
  });

  $routes->get('/tyomies/:id/nollaa', function($id){
    TyomiesController::nollaa_tunnit($id);
  });

  $routes->post('/tyomies/:id/destroy', function($id){
    TyomiesController::destroy($id);
  });

  //Merkinta
  $routes->get('/merkinta/:id', function($id) {
    MerkintaController::create($id);
  });

  $routes->post('/merkinta', function(){
    MerkintaController::store();
  });

  $routes->post('/merkinta/:id/destroy', function($id){
    MerkintaController::destroy($id);
  });

//User & Login
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

  $routes->get('/tyomies/:id/salasana', function($id){
    UserController::edit_password($id);
  });

  $routes->post('/tyomies/:id/salasana', function($id){
    UserController::update_password($id);
  });
  
  $routes->post('/tyomies/:id/reset', function($id){
    UserController::reset_password($id);
  });