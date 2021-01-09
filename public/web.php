<?php
// Bu script @omerfarukbicer tarafından Cibza için yapılmıştır ve halka açık bir şekilde sunulmuştur.

$app = new Route;

$app->get('/', function(){
  Route::view('welcome');
});

$app->get('/controller', function(){
  Route::controller('welcome');
});

$app->get('/model', function(){
  Route::model('welcome');
});

$app->run();