<?php

$user_id = $_GET['id'];
$token = $_GET['token'];
require 'config.php';
$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
$req->execute([$user_id]);
$user = $req->fetch();
session_start();

if($user && $user->confirmation_token == $token){
    $pdo->prepare('UPDATE users SET confirmation_token = NULL, confirmed_at= NOW() WHERE id=?')->execute([$user_id]);
    $_SESSION['flash']['success'] = 'your account has been validated';
    $_SESSION['auth'] = $user;
    header('location: ../index.php');
    die('ok');
}else{
    $_SESSION['flash']['danger'] = "<h5 style='display: block;
    background: #D9AAB7;
    padding-top:7px;
    font-size: 0.8rem;
    
    color:#fff;
    text-align: center;
    width:280px;
    height:40px;
    border-radius:20px; 
    margin-left:500px;
    margin-top:30px;'> This token is no longer </h5> ";
    header('location: login.php');
}