<?php

namespace App\Controllers;

use App\Core\Constants;
use App\Utils\Helper;
use Exception;

abstract class Controller {

  protected static ?object $instance = null; 
  protected static string $id = ''; 


  abstract public function page(array $params = null);


  protected function view(string $name,array $payload,array $additional = []){

    if(isset($payload['style']))
      $payload['style'] = Helper::join_path(Constants::STYLE_PATH,$payload['style']);
    if(isset($payload['script']))
      $payload['script'] = Helper::join_path(Constants::SCRIPT_PATH,$payload['script']);
    if(isset($payload['images'])){
      foreach(array_keys($payload['images']) as $image){
        $payload['images'][$image] = Helper::join_path(Constants::IMAGE_PATH,$payload['images'][$image]);
      } 
    }

    // for global css and js bundle
    $payload['bootstrap_css'] = Constants::BOOTSTRAP_CSS;
    $payload['bootstrap_js'] = Constants::BOOTSTRAP_JS;
    $payload['jquery'] = Constants::JQUERY;
    $payload['BASE_URL'] = Constants::ROOT_PATH;

    require_once Helper::join_path(Constants::VIEW_PATH,'templates/header.php');
    require_once Helper::join_path(Constants::VIEW_PATH,$name . '.php'); 
    foreach($additional as $component){
      require_once Helper::join_path(Constants::VIEW_PATH,$component . '.php'); 
    }
    require_once Helper::join_path(Constants::VIEW_PATH,'templates/footer.php');
  } 

  public static function render(){
    if(static::$instance === null){
        if(static::$id === '') throw new Exception('id class tidak boleh kosong !');
        $instance = new static::$id(); 
    };
    return $instance;
  } 

}




