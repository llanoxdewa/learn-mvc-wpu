<?php

namespace App\Models;


use App\Models\Model;


class M_Mahasiswa extends Model {
  
  protected static string $model = __CLASS__;


  public int    $id; 
  public string $name; 
  public string $nim; 
  public string $major; 
  public int    $age; 
  public string $email; 



  public static function getAll(){
    return self::fetch('SELECT * FROM mahasiswa');
  } 

  public static function getBy(string $key, int | string $value,bool $assoc = false){
    $query = "SELECT * FROM mahasiswa WHERE $key = ?";
    $res = $assoc ? self::fetch_assoc($query,[$value]) : self::fetch($query,[$value]); 
    return $res !== null && count($res) > 0 ? $res[0] : null || false;
  }

  public static function find(string $key){
    if($key === '')
      return self::getAll();
    $sql = "
      SELECT * 
      FROM mahasiswa 
      WHERE 
          name LIKE CONCAT('%', :key, '%') 
          OR nim LIKE CONCAT('%', :key, '%') 
          OR email LIKE CONCAT('%', :key, '%')
          OR major LIKE CONCAT('%', :key, '%')
    ";
    $res = self::fetch($sql,['key' => $key]
    );
    return $res;
  }

  

  public static function insert(string $name, string $nim, string $major, int $age, string $email){
    self::mutate('
      INSERT INTO mahasiswa (name,nim,email,age,major) 
      VALUES (?,?,?,?,?)
    ',[$name,$nim,$email,$age,$major]);
  }


  public static function update(int $id,string $name, string $nim, string $major, int $age, string $email){
    self::mutate('
      UPDATE mahasiswa set 
      name      = ?,
      nim       = ?,
      email     = ?,
      age       = ?,
      major     = ? 
      WHERE id  = ?',[$name,$nim,$email,$age,$major,$id]);
  }

  public static function removeBy(string $key, int | string $value){
    $res = self::mutate("DELETE FROM mahasiswa WHERE $key = ?",[$value]); 
    return $res; 
  }

  public function __set($name, $value){}
}




