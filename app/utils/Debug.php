<?php

namespace App\Utils;

use App\Utils\Logging;

class Debug extends Logging {

  public function __construct(string $file_location){
    parent::__construct($file_location);
  } 

  public function dbg(int $line,string $msg){
    $current_time = $this->get_current_time(); 
    echo "[$current_time] ($line) -> {$this->fname} _> $msg\n";
  }

}; 


