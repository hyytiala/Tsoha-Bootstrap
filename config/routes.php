<?php

  $routes->get('/', function() {
    HelloWorldController::index();
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