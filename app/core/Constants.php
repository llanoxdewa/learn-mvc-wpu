<?php

namespace App\Core;

use App\Utils\Helper;



define('_VIEW_PATH',Helper::join_path(__DIR__,'../views'));

class Constants {
  // public
  const ROOT_PATH = "http://localhost:5000";
  const VIEW_PATH = _VIEW_PATH;
  const STYLE_PATH = "http://localhost:5000/css";
  const SCRIPT_PATH = "http://localhost:5000/js";
  const IMAGE_PATH = "http://localhost:5000/images";


  // third party 
  const BOOTSTRAP_CSS = "http://localhost:5000/css/bootstrap.min.css";
  const BOOTSTRAP_JS = "http://localhost:5000/js/bootstrap.bundle.min.js";
  const JQUERY = "http://localhost:5000/js/jquery-3.7.1.min.js";

  // model  
  const HOSTNAME = 'localhost';
  const DB = 'mysql';
  const DB_NAME = 'learn_mvc';
  const DB_PORT = 3306;
  const DB_USERNAME = 'root';
  const DB_PASSWORD = '';


  // session management 
  const FLASH_MESSAGE_NAME = 'flash_msg';
  const LOGIN_SESSION_KEY = 'login-session';   
  const LOGIN_COOKIE_KEY = 'login-cookie';  
  const LOGIN_VALID_EXPIRATION_TIME = 60 * 60 * 24; // 1 day 

  // data security 
  const ENCRYPTION_KEY = 'fsjfasldkfjlsakdjf'; // Use a secure key
  const ENCRYPTION_METHOD =  'AES-256-CBC'; // Strong encryption method
}; 



