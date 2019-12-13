<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Container;

class WelcomeController{

  function index(){
    //return __NAMESPACE__;
    $user = User::find(1);
    $app = Container::getInstance();
    $factory = $app->make('view');
    return $factory->make('welcome')->with('user', $user);
    return 'controller success.';
  
  }

}

?>