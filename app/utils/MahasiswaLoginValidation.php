<?php


namespace App\Utils;

use App\Models\M_Mahasiswa;
use App\Utils\FormValidation;
use Exception;

class MahasiswaFormValidation extends FormValidation {

  private array $data = [];
  private array $regex_validation_pattern = [
    'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'name' => '/^[a-zA-Z\s]+$/',
    'nim' => '/^[a-zA-Z0-9]+$/',
    'age' => '[0-9]+', 
  ];

  private array $validate_methods = [
    'email' => 'validate_email',
    'name'  => 'validate_name',
    'nim'   => 'validate_nim'
  ];

  private array $disableUniq = [
    'name' => false,
    'nim' => false 
  ];

  public function __construct(){

    M_Mahasiswa::init();

    $this->data['id']     = filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT);
    $this->data['name']   = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
    $this->data['email']  = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
    $this->data['nim']    = filter_input(INPUT_POST,'nim',FILTER_SANITIZE_SPECIAL_CHARS);
    $this->data['age']    = filter_input(INPUT_POST,'age',FILTER_SANITIZE_NUMBER_INT);
    $this->data['major']  = filter_input(INPUT_POST,'major',FILTER_SANITIZE_SPECIAL_CHARS);
  }

  private function validate_name(string $name){
    
    $name_is_valid = $this->validateRegex($name,'name'); 
    if(!$name_is_valid)
      return $this->return_value($name,false,"$name is not valid");

    $name_exists = $this->disableUniq['name'] || !M_Mahasiswa::getBy('name',$name);

    return $this->return_value($name,$name_exists,"$name is already used"); 
  } 

  private function validate_nim(string $nim){


    $nim = $this->validateRegex($nim,'nim');

    if (!$nim) 
      return $this->return_value($nim,false,'nim not valid');

    $nim_exists = $this->disableUniq['nim'] || !M_Mahasiswa::getBy('nim',$nim);

    return $this->return_value($nim,$nim_exists,'nim is already used'); 
  } 

  private function validate_email(string $email){
    $email_valid = filter_var($email,FILTER_VALIDATE_REGEXP,[
      'options' => [
        'regexp' => $this->regex_validation_pattern['email']
      ]
    ]);
    return $this->return_value($email,$email_valid,'email tidak valid');
  } 


  public function disableUniqValidation(string $key){
    $this->disableUniq[$key] = true; 
  } 

  public function __toString(){
    return "[".join(',',array_values($this->data))."]"; 
  }

};


