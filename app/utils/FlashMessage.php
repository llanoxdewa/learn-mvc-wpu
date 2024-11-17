<?php

namespace App\Utils;


use App\Core\Constants;



class FlashMessage { 


  const FLASH_INFO = 'info';
  const FLASH_WARNING = 'warning';
  const FLASH_ERROR = 'danger';
  const FLASH_OK = 'success';


  public static function set_message(string $msg, string $type = self::FLASH_INFO) {
      self::init(); 

      $_SESSION[Constants::FLASH_MESSAGE_NAME][] = [
          'msg' => $msg,
          'type' => $type
      ];
  }

  public static function show_message(){
    self::init();

    $all_messages = $_SESSION[Constants::FLASH_MESSAGE_NAME];
      
    self::destroy_messages();

    return $all_messages;
  }


  private static function init(){
    if(!isset($_SESSION[Constants::FLASH_MESSAGE_NAME]))
       $_SESSION[Constants::FLASH_MESSAGE_NAME] = [];
  }    


  private static function destroy_messages(){
    unset($_SESSION[Constants::FLASH_MESSAGE_NAME]); 
    self::init();
  }

} 






