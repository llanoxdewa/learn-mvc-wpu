<?php

namespace App\Utils;


class Logging {

  protected string $fname;

  public function __construct(string $file_location){
    $this->fname = $this->get_filename($file_location); 
  }


  protected function gen_log(string $type, string $msg){
    $time = $this->get_current_time();
    echo "[$time]@[{$this->fname}]T[$type]_> $msg\n";
  }

  public function ilog(string $msg){
    $this->gen_log('INFO',$msg);
  }

  public function elog(string $msg){
    $this->gen_log('ERROR',$msg);
  }

  public function wlog(string $msg){
    $this->gen_log('WARNING',$msg);
  }

  public function get_current_time(){
    return date('h:i:s',time());
  }

  public function get_filename(string $file_location){
    $arr_fname = explode('\\',$file_location); 
    $long = count($arr_fname);
    $slice_fname = array_slice($arr_fname,$long - 2);
    return join('/',$slice_fname);
  } 

}




