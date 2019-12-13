<?php

$app['router']->get('/', function(){
  //dd(__NAMESPACE__);
  return '<h1>router success.</h1>';
});

$app['router']->get('/welcome', 'App\Http\Controllers\WelcomeController@index');
?>