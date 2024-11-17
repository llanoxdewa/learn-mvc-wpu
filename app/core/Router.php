<?php



//$pattern = '/:(\w+)/';

//$new_reg = preg_replace($pattern, '(.+)', $url);
//$new_reg = '#^' . $new_reg . '$#';



namespace App\Core;


class Router {

  private array $get_routes = []; 
  private array $post_routes = []; 
  private string $url = '';

  public function __construct(){
    $this->url = $this->sanitize_url();  
  }
  
  private function genRegex(string $path){
    $pattern = '/:(\w+)/';
    $new_reg = preg_replace($pattern, '(?<\1>.+)', $path);
    return '#^' . $new_reg . '$#';
    
  }

  private function sanitize_url(){
    $clean_url = filter_var($_SERVER['REQUEST_URI'],FILTER_SANITIZE_URL);

    return $clean_url;
  }

  public function get(string $path,object $controller,string $handler = 'page'){
    $matcher = $this->genRegex($path);
    $this->get_routes[$matcher] = [$controller,$handler];
  }


  public function post(string $path,object $controller,string $handler = 'page'){
    $matcher = $this->genRegex($path);
    $this->post_routes[$matcher] = [$controller,$handler];
  }

  //private function path_exist_get(){
    //return array_key_exists($this->url,$this->get_routes);
  //}

  //private function path_exist_post(){
    //return array_key_exists($this->url,$this->post_routes);
  //}


  public function get_current_method(){
    return $_SERVER['REQUEST_METHOD'];
  }


  private function parse_url(){
    $handler = null;
    $params = [];
   
    $pattern_q_mark = '/\?(?<url_data>.*)/';
    $this->url = preg_replace($pattern_q_mark,'',$this->url);
    
    
    $routes = $this->get_current_method() === 'GET' ? $this->get_routes : $this->post_routes;  
    
    // matching params and pattern from path 
    foreach($routes as $path_pattern => $path_handler){
        $find_path = null; 
        preg_match($path_pattern,$this->url,$find_path);
        if(count($find_path) > 0){
          $handler = $path_handler; 
          if(count($find_path) > 1){
            $params = array_map(
              fn(string $val) => ltrim($val,':'),
              array_slice($find_path,1)
            );
          }
          break;
        }
      }

    return [$handler,$params];
  }

  private function get_handler(){
    [$handler,$params] = $this->parse_url();

    if($handler)
      $handler($params);
  }

  private function post_handler(){

    [$handler,$params] = $this->parse_url();

    if($handler)
      $handler($params);
  }

  public function start(){

    $current_method = $this->get_current_method();


    switch($current_method){
      case 'GET':
        $this->get_handler();
        break;
     case 'POST':
        $this->post_handler();
        break;
     default: 
        echo "method not allowed\n";
        break;
    }
  
  }

}





