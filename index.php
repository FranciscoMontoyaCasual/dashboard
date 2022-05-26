<?php
include __DIR__."/test/db.php";
include __DIR__."/utilities/cookie.php";

$request = $_SERVER['REQUEST_URI'];

switch($request){
    case '/create':
      include __DIR__ . '/routes/create.php';
      break;
    default:
      set_basic_configuration();
      break;
}

function set_basic_configuration(){
  $db = DB::connect_db();
  if($_COOKIE['uid'] && $_COOKIE['rid'] == 1)
  include __DIR__."/views/home.php";
  else if($_COOKIE['uid'] && ($_COOKIE['rid'] == 2 || $_COOKIE['rid'] == 4))
  include __DIR__."/views/home_area_manager.php";
  else{
  if(isset($_POST['user_name']) && isset($_POST['password'])){
    $user_name = $_POST['user_name'];
    $pass = $_POST['password'];

    $result = DB::auth_user($db, $user_name, $pass);

    if($result['msg'])
      include __DIR__."/views/login.php";
    else if($result['rol'] == 1){
      Cookie::set_cookie('uid', $result['uid'], 4102466399);
      Cookie::set_cookie('rid', $result['rol'], 4102466399);
      header('Location: /');
    }else{
      Cookie::set_cookie('uid', $result['uid'], 4102466399);
      Cookie::set_cookie('rid', $result['rol'], 4102466399);
      Cookie::set_cookie('aid', $result['aid'], 4102466399);
      header('Location: /');
    }
  }else
    include __DIR__."/views/login.php";
  }
}
?>