<?php
function debug($variable){
    echo'<pre>'  .print_r($variable, true) . '</pre>';
}

function str_random($length){
  $alphabet="0123456789qwertyuioplkjhgfdsazxcvbnmMNBVCXZLKJHGFDSAQWERTYUIOP";
  return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);

}

function logged_only(){
  if(session_status() == PHP_SESSION_NONE){

    session_start();
}



if(!isset($_SESSION['auth'])){
  $_SESSION['flash']['danger'] = "You do not have the right to access this page";
  header('location: login.php');
  exit();
}
}

function reconnect_from_cookie(){
  if(session_status() == PHP_SESSION_NONE){

    session_start();
  }
  if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
    require 'config.php';
    if(!isset($pdo)){
      global $pdo;
    }
    
    $remember_token = $_COOKIE['remember'];
    $parts = (explode('==', $remember_token));
    $user_id = $parts[0];
    $req = $pdo->prepare('SELECT * FROM users WHERE ID = ? ');
    $req->execute([$user_id]);
    $user = $req->fetch();
    if($user){
      $expected = $user->id . '==' . $user->$remember_token . sha1($user->id . 'ratonlaveurs');

      if($expected == $remember_token){
         session_start();
       $_SESSION['auth'] = $user;
       setcookie('remember',  $remember_token, time() + 60 * 60 * 24 * 7);
      }else{
        setcookie('remember', null, -1);
      }
    }else{
      setcookie('remember', null, -1);
    }
 }
}