<?php

namespace App\Utils;

use App\Core\Constants;

class Helper {

  public static function join_path(string ...$paths): string {
    $path = join(DIRECTORY_SEPARATOR,array_map(fn(string $path) => join(DIRECTORY_SEPARATOR,explode('/',$path)),$paths)); 
    return $path;
  }
  
  public static function redirect(string $location){
    header("Location: $location");
    exit();
  }

  public static function encryptData($data, $key){
      $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(Constants::ENCRYPTION_METHOD));
      $encrypted = openssl_encrypt($data, Constants::ENCRYPTION_METHOD, $key, 0, $iv);
      return base64_encode($encrypted . '::' . $iv);
  }

  public static function decryptData($encryptedData, $key){
      $parts = explode('::', base64_decode($encryptedData), 2);
      if (count($parts) !== 2) {
          return false; // Invalid data format
      }
      [$encrypted, $iv] = $parts;
      return openssl_decrypt($encrypted, Constants::ENCRYPTION_METHOD, $key, 0, $iv);
  }

};


