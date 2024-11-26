<?php

namespace App\Models; 

use App\Models\Model;

class M_User extends Model {

  protected static string $model = __CLASS__; 


  public string $username; 
  public string $email; 
  public string $password; 
  public string $role;


  public static function storePassword(string $rawPassword){
    return password_hash($rawPassword,PASSWORD_BCRYPT); 
  }

  public static function getUserBy(string $key, string $value){
    try {
      $res = self::fetch("select * from users where $key = ?",[$value]); 
      return $res && count($res) > 0 ? $res[0] : null;
    } catch(\Exception $ex){
      echo $ex->getMessage();
      return null;
    }
  }

  public static function create(string $username,string $password, string $email){
    $password = self::storePassword($password); 
    self::mutate("
      INSERT INTO Users 
      (username,password,email) values
      (?,?,?)
    ",[$username,$password,$email]);    
  } 



  public function __set($name, $value){} 

}


