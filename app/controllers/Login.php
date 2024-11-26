<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Core\Constants;
use App\Utils\Helper;
use App\Models\M_User;
use App\Utils\FlashMessage;

class Login extends Controller {

  protected static string $id = __CLASS__;

  private static array $payload = [
    'title' => 'Login Page',
    'style' => 'login/style.css',
    'images' => [
      'img_eye-open' => 'login/eye-open.png',
      'img_eye-close' => 'login/eye-close.png',
    ],
    'script' => 'login/script.js',
  ]; 


  public static function loginRequired(){
    if(!isset($_SESSION[Constants::LOGIN_SESSION_KEY])){

      // cek for cookie
      if(isset($_COOKIE[Constants::LOGIN_COOKIE_KEY])){
        $_SESSION[Constants::LOGIN_SESSION_KEY] = $_COOKIE[Constants::LOGIN_COOKIE_KEY];
      } else 
        Helper::redirect(Constants::ROOT_PATH);
    } 
  }  


  public static function userIsLogin(){
    if(!isset($_SESSION[Constants::LOGIN_SESSION_KEY])){

      // cek for cookie
      if(isset($_COOKIE[Constants::LOGIN_COOKIE_KEY]))
        $_SESSION[Constants::LOGIN_SESSION_KEY] = $_COOKIE[Constants::LOGIN_COOKIE_KEY];
      else 
        return false;
    } 
    return true;
  } 

  public function saveLogin($payload){
    setcookie(Constants::LOGIN_COOKIE_KEY,$payload,time() + Constants::LOGIN_VALID_EXPIRATION_TIME);    
  } 

  public function page(array $params = null){
    self::$payload['login-handler'] = Helper::join_path(Constants::ROOT_PATH,'login/handler'); 
    $this->view('login',self::$payload);
  } 

  public function loginHandler(){
    $username   = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS); 
    $password   = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS); 
    $save_login = filter_input(INPUT_POST,'remember-me',FILTER_SANITIZE_SPECIAL_CHARS); 


    $mhs = M_User::getUserBy('username',$username); 

    if($mhs){
      $valid_password = $mhs->password;
      if(password_verify($password,$valid_password)){
        
        $user_data = json_encode([
          'username' => $mhs->username,  
          'email'    => $mhs->email  
        ]); 
        
        $encrypted_user_data = Helper::encryptData($user_data,Constants::ENCRYPTION_KEY);

        if($save_login)
          $this->saveLogin($encrypted_user_data);

        $_SESSION[Constants::LOGIN_SESSION_KEY] = $encrypted_user_data; 
        

        Helper::redirect(Helper::join_path(Constants::ROOT_PATH,'mahasiswa'));
      }
      FlashMessage::set_message('password salah !!!',FlashMessage::FLASH_ERROR);
      Helper::redirect(Helper::join_path(Constants::ROOT_PATH,'login'),FlashMessage::FLASH_ERROR);
    }
    
    FlashMessage::set_message('user tidak ditemukan !!!',FlashMessage::FLASH_ERROR);
    Helper::redirect(Helper::join_path(Constants::ROOT_PATH,'login'));
  }

  // BIG WITH PHP -s localhost:5000 -t ./public
  // recomend to use apache server
  public function logout(){
    $_SESSION[Constants::LOGIN_SESSION_KEY] = array();
    session_destroy();
    unset($_COOKIE[Constants::LOGIN_COOKIE_KEY]);
    setcookie(Constants::LOGIN_COOKIE_KEY, "", time() - 3600);
    Helper::redirect(Constants::ROOT_PATH);
  } 

}




