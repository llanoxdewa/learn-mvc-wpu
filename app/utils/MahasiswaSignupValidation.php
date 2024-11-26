<?php


namespace App\Utils;

use App\Models\M_User;
use App\Utils\FormValidation;
use Exception;

class MahasiswaSignupValidation extends FormValidation {

  protected array $regex_validation_pattern = [
    'email'     => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'username'  => '/^[a-zA-Z\s]+$/',
    'password'  => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' 
  ];

  protected array $validate_methods = [
    'username'    => 'validate_username',
    'password'    => 'validate_password',
    'email'       => 'validate_email',
  ];


  public function __construct(){

    M_User::init();
    $this->data['username']   = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
    $this->data['password']   = filter_input(INPUT_POST,'password',FILTER_SANITIZE_SPECIAL_CHARS);
    $this->data['email']      = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);

  }

  protected function validate_username(string $username){
    

    $username_str_valid = $this->validateRegex($username,'username');

    if(!$username_str_valid)
      return $this->return_value($username_str_valid,false,'username tidak valid');   
    

    $username_exists = M_User::getUserBy('username',$username_str_valid); 

    return $this->return_value($username_str_valid,!$username_exists,'username telah digunakan');

  } 

  protected function validate_password(string $password){
    $password_str_valid = $this->validateRegex($password,'password');
    return $this->return_value($password,$password_str_valid,'password harus terdiri dari huruf besar, kecil dan angka !!');
  } 

  protected function validate_email(string $email){
    $email_valid = filter_var($email,FILTER_VALIDATE_REGEXP,[
      'options' => [
        'regexp' => $this->regex_validation_pattern['email']
      ]
    ]);
    if(!$email_valid)
      return $this->return_value($email,$email_valid,'email tidak valid');



    $email_exists = M_User::getUserBy('email',$email);

    return $this->return_value($email,!$email_exists,'email sudah digunakan');
  } 


  public function disableUniqValidation(string $key){
    $this->disableUniq[$key] = true; 
  } 

  public function __toString(){
    return "[".join(',',array_values($this->data))."]"; 
  }

};


