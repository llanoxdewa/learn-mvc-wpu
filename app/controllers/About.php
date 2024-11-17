<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Core\Constants;
use App\Utils\Helper;
use App\Controllers\Login;

class About extends Controller {

  protected static string $id = __CLASS__;    


  private static array $payload = [
    'title' => 'About Page',
  ];

  

  public function page(array $params = null){

    Login::loginRequired();

    $user_data = Helper::decryptData($_SESSION[Constants::LOGIN_SESSION_KEY],Constants::ENCRYPTION_KEY); 

    self::$payload['user'] = json_decode($user_data); 

    $this->view('about',self::$payload);
  }

}



