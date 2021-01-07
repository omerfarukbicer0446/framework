<?php
// Bu script @omerfarukbicer tarafından Cibza için yapılmıştır ve halka açık bir şekilde sunulmuştur.
$path = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router($path, $method);

$router->get('/', function(){
  Route::view('welcome');
});

$router->run();