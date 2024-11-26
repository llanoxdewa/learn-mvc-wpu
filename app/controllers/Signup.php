<?php

namespace App\Controllers;

use App\Controllers\Controller;
Use App\Utils\Helper;
Use App\Core\Constants;
use App\Models\M_User;
use App\Utils\MahasiswaSignupValidation;
use App\Utils\FlashMessage;

class Signup extends Controller {

  protected static string $id = __CLASS__;    

  private static array $payload = [
    'title' =>  'Signup Page',
    'style' =>  'signup/style.css'
  ];

  public function page(array $params = null){
    self::$payload['signup-handler'] = Helper::join_path(Constants::ROOT_PATH,'signup');


    $this->view('signup',self::$payload);
  }

  public function signupHandler(){
    $validator = new MahasiswaSignupValidation(); 

    $username = $validator->get_validate_value('username');
    $password = $validator->get_validate_value('password');
    $email    = $validator->get_validate_value('email');
    
    // this should be inside validator class  
    if(!$validator->valid_all()){
      foreach($validator->get_invalid_messages() as $invalid_message)
        FlashMessage::set_message($invalid_message,FlashMessage::FLASH_ERROR);
    };


    if($validator->valid_all()){
        FlashMessage::set_message("User $username berhasil dibuat",FlashMessage::FLASH_OK);
        M_User::create(
          username: $username,
          password: $password,
          email   : $email
        );
    }

    $callback_url = Helper::join_path(Constants::ROOT_PATH,'signup');;

    header("Location: $callback_url");
  }

}



