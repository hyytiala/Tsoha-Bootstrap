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
