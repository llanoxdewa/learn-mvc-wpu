<?php
// start the session

if(session_status() === PHP_SESSION_NONE){
  session_start();
}


require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\Home;
use App\Controllers\About;
use App\Controllers\Login;
use App\Controllers\Mahasiswa;
use App\Controllers\Signup;

$router = new Router();

//other route handler
$router->get('/',Home::render());
$router->get('/dummy',Home::render(),'dummy');
$router->get('/about',About::render());

// mahaissw rouote handler
$router->get('/mahasiswa',            Mahasiswa::render());
$router->get('/mahasiswa/fetch',      Mahasiswa::render(),'getById');
$router->post('/mahasiswa/update/:id',Mahasiswa::render(),'updateMahasiswaHandler');
$router->get('/mahasiswa/delete/:id', Mahasiswa::render(),'deleteMahasiswaHandler');
$router->post('/mahasiswa/add',       Mahasiswa::render(),'addMahasiswaHandler');
$router->get('/mahasiswa/detail/:id', Mahasiswa::render(),'detail');
$router->post('/mahasiswa/detail/update/:id', Mahasiswa::render(),'detailUpdateHandler');

// login route handler
$router->get('/login',Login::render());
$router->get('/logout',Login::render(),'logout');
$router->post('/login/handler',Login::render(),'loginHandler');


// singup route handler
$router->get('/signup',Signup::render());
$router->post('/signup',Signup::render(),'signupHandler');



// start the routing 
$router->start();




