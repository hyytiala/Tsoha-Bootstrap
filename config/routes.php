<?php

  $routes->get('/', function() {
    UserController::login();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kohteet', function() {
    HelloWorldController::kohteet();
  });

  $routes->get('/muokkaa', function() {
    HelloWorldController::muokkaa();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/asiakkaat', function() {
    HelloWorldController::asiakkaat();
  });

  $routes->get('/asiakasmuok', function() {
    HelloWorldController::asiakasmuok();
  });

  $routes->get('/tyomiehet', function() {
    HelloWorldController::tyomiehet();
  });

  $routes->get('/tyomiesmuok', function() {
    HelloWorldController::tyomiesmuok();
  });

  //vkon 3 asioita down here
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
  $routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
  });
  $routes->post('/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
  });