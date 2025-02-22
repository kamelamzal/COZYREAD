<?php

$host='localhost';
$user='root';
// password
$pass='';
//database
$db='ecommerce';
//declarer tt les var
$con=mysqli_connect($host,$user,$pass,$db);




if(!$con){
    die(mysqli_error());
}

?>