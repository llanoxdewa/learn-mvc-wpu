<?php

namespace App\Utils;

class FormValidation {

  protected array $data = [];
  protected array $regex_validation_pattern = [];
  protected array $validate_methods = [];
  protected array $disableUniq = [];
  protected array $invalid_messages = []; 


  public function get_validate_value(string $key){

    if(!array_key_exists($key,$this->validate_methods)) return null;

    $validate_method = $this->validate_methods[$key];


    if(!method_exists($this,$validate_method))
      throw new \BadMethodCallException('missing validate method !!');

    $value = $this->get_value($key);

    return $this->$validate_method($value);
  }

  public function get_value(string $key){
    return array_key_exists($key,$this->data) ? $this->data[$key] : null; 
  }

  public function valid_all(){
    return count($this->invalid_messages) == 0;
  }

  public function get_invalid_messages(){
    return $this->invalid_messages;
  }

  protected function return_value(string $value, bool $valid, string $invalid_msg = ''){
    
    if(!$valid)
      $this->invalid_messages[] = $invalid_msg;
    return $value;
  }

  protected function validateRegex(mixed $value,string $regexKey){
    return array_key_exists($regexKey,$this->regex_validation_pattern) ? 
      filter_var($value,FILTER_VALIDATE_REGEXP,[
      'options' => [
        'regexp' => $this->regex_validation_pattern[$regexKey]
      ] 
    ]) : null;
  }

  public function disableUniqValidation(string $key){
    $this->disableUniq[$key] = true; 
  } 

  public function __toString(){
    return "[".join(',',array_values($this->data))."]"; 
  }

};




