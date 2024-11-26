<?php

namespace App\Controllers;
 
use App\Controllers\Controller;
use App\Controllers\Login;
use App\Models\M_Mahasiswa;
use App\Utils\Helper;
use App\Core\Constants;
use App\Utils\FlashMessage;
use App\Utils\MahasiswaFormValidation;


class Mahasiswa extends Controller {

  protected static string $id = __CLASS__;
  private static string $url_mahasiswa;

  public function __construct(){
    M_Mahasiswa::init();
    self::$url_mahasiswa = helper::join_path(Constants::ROOT_PATH,'mahasiswa'); 
  }

  private static array $payload = [
    'title'   => 'Mahasiswa',
    'style'   => 'mahasiswa/style.css',
    'script'  => 'mahasiswa/script.js'
  ];

private static array $detailPayload = [
    'title'   => 'mahasiswa | detail',
    'style'   => 'mahasiswa/detail-style.css',
    'script'  => 'mahasiswa/detail-script.js',
    'images'  => [
      'img_profile' => 'profile.png'  
    ],
  ];


  public function page(array $params = null){
   
    Login::loginRequired();

    self::$payload['form-handler'] = Helper::join_path(Constants::ROOT_PATH,'mahasiswa/add');

    
    $query = isset($_GET['q']) ? $_GET['q'] : ''; 

    $results = M_Mahasiswa::find($query);

    // adding data mahasiswa to template views 
    self::$payload['data-mahasiswa'] = $results; 

    $this->view('mahasiswa',self::$payload,[
      'mahasiswa-form-modal' 
    ]);
  }


  public function detailUpdateHandler(array $params){
    $id = $params['id'];
    $callback_url = self::$url_mahasiswa . '/detail/' . $id;
    $this->updateMahasiswaHandler($params,$callback_url);
  } 

  public function detail(array $params = null){

    $id = $params['id']; 

    self::$detailPayload['form-handler'] = self::$url_mahasiswa . '/detail/update/' . $id;

    $mhs = M_Mahasiswa::getBy('id',$id);

    self::$detailPayload['mhs'] = $mhs;

  
    $this->view('mahasiswa-detail',self::$detailPayload,[
      'mahasiswa-form-modal' 
    ]);
  }

  public function addMahasiswaHandler(){
      $validator = new MahasiswaFormValidation(); 



      $name   = $validator->get_validate_value('name');
      $nim    = $validator->get_validate_value('nim');
      $email  = $validator->get_validate_value('email');
      $age    = $validator->get_value('age');
      $major  = $validator->get_value('major');


      if(!$validator->valid_all()){
        foreach($validator->get_invalid_messages() as $invalid_message)
          FlashMessage::set_message($invalid_message,FlashMessage::FLASH_ERROR);
      };
      
      
      
      // database process 
      if($validator->valid_all()){
        FlashMessage::set_message("Mahasiswa $name berhasil ditambahkan ✔");
        M_Mahasiswa::insert(
          name  : $name,
          email : $email,
          age   : $age,
          major : $major,
          nim   : $nim
        );
      }

      header("Location: ". self::$url_mahasiswa);
  }



  // need to expand this
  public function getById(){
    $id = $_GET['id'];

    $mhs = M_Mahasiswa::getBy('id',$id,assoc: true);

    ob_clean();
    echo json_encode($mhs);
  } 

  public function updateMahasiswaHandler(array $params,string $callback_url = null){

      if($callback_url === null)
        $callback_url = self::$url_mahasiswa;

      $validator = new MahasiswaFormValidation(); 


      $validator->disableUniqValidation('name');  
      $validator->disableUniqValidation('nim');  

      $id     = $params['id'];
      $name   = $validator->get_validate_value('name');
      $nim    = $validator->get_validate_value('nim');
      $email  = $validator->get_validate_value('email');
      $age    = $validator->get_value('age');
      $major  = $validator->get_value('major');

      if(!$validator->valid_all()){
        foreach($validator->get_invalid_messages() as $invalid_message)
          FlashMessage::set_message($invalid_message,FlashMessage::FLASH_ERROR);
      };
      
      
      
      // database process 
      if($validator->valid_all()){
        FlashMessage::set_message("Mahasiswa $name berhasil di update ✔");
        M_Mahasiswa::update(
          id    : $id,
          name  : $name,
          email : $email,
          age   : $age,
          major : $major,
          nim   : $nim
        );
      }

      header('Location: ' . $callback_url);
  }


  public function deleteMahasiswaHandler(array $params){
    $id = $params['id'];

    M_Mahasiswa::removeBy('id',$id);
    
    
    FlashMessage::set_message('mahasiswa telah berhasil dihapus ✔');
    header('Location: ' . self::$url_mahasiswa);
  }  

}






