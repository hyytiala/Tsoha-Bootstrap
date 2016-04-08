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

  $routes->get('/kohde', function() {
    HelloWorldController::kohde();
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
  $routes->get('/asiakas', function() {
    AsiakkaatController::index();
  });
