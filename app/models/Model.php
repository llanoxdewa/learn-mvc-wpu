<?php


// model merupakan representasi dari data yang ada di database

namespace App\Models;

use App\Core\Constants;
use App\Utils\Logging;



abstract class Model {

  protected static ?\PDO $db = null; 
  protected static string $dsn = Constants::DB . ":dbname=" . Constants::DB_NAME . ";host=" . Constants::HOSTNAME . ";port=" . Constants::DB_PORT;
  
  // should be implement on every model 
  private static string $model = '';


  // every function should implement thsi function
  // to avoid error because there no property that match on db field
  abstract public function __set($name, $value);  


  public static function init(){
    if(self::$db === null)
      self::$db = new \PDO(self::$dsn,Constants::DB_USERNAME,Constants::DB_PASSWORD); 
  }


  // fetch is super function
  // it can do query and mutate data on db 
  public static function fetch(string $queryString, array $args = null,bool $assoc = false){
    if(self::$db === null) return null;
    try {
      // if there is no argument use query instead 
      $q = $args ? self::$db->prepare($queryString) : self::$db->query($queryString);
      
      // it does'nt matter if query prepare, just using execute even if the args is null 
      // there is no need to add logic for that
      $q->execute($args);

      if($assoc)
        return $q->fetchAll(\PDO::FETCH_ASSOC); 

      return $q->fetchAll(\PDO::FETCH_CLASS,static::$model); 
    } catch(\Exception $ex){
      return null;
    }
  }

  public static function fetch_assoc(string $queryString, array $args = null){
    return self::fetch($queryString,$args,true);
  }



  public static function mutate(string $queryString, array $args = null){
    if(self::$db === null) return null;
    try {
      // if there is no argument use query instead 
      $q = $args ? self::$db->prepare($queryString) : self::$db->query($queryString);
      
      // it does'nt matter if query prepare, just using execute even if the args is null 
      // there is no need to add logic for that
      $q->execute($args);

      return $q->columnCount();

    } catch(\Exception $ex){
      return null;
    }
  }


};



