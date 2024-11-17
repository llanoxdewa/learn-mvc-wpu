<?php

namespace App\Controllers;

use App\Controllers\Controller;



class Home extends Controller {

  protected static string $id = __CLASS__; 
  
  
  private static array $payload = [
    'title' => 'Home Page',
    'style' => 'home/style.css'
  ];



  public function page(array $params = null){
    $this->view('home',self::$payload);
  }


}



