<?php
require 'config.php';
session_start();

 $admin_id =  $_SESSION['admin_id'];

 if(!isset($admin_id)){
    header('location:admin_login.php');
 };

 if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $password = ($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $cpassword = ($_POST['cpassword']);
    $cpassword = filter_var($cpassword, FILTER_SANITIZE_STRING);

    $select_admin = $pdo->prepare("SELECT * FROM admins WHERE email = ? ");
    $select_admin->execute([$email]);
    

    if($select_admin->rowcount() > 0){
       $message[] ='email already exist!';

    }else{
        if($password != $cpassword){
            $message[] = 'confirm password not matched!';
        }else{
            $insert_admin = $pdo->prepare("INSERT INTO admins (name,email, password) VALUES (?,?,?)");
            $insert_admin->execute([$name,$email, $password]);
            $message[] = 'new admin registred!';
        }
    }

}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> register admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>
    <?php include 'admin_header.php' ?>
    <div class="icon">
<a href="../cread/dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>
    <div class="form-container">
     <form action="" method="post" style="   border:none;border-radius:20px;">
        <h3>Register new</h3>
        
     <input type="text" name="name"  required placeholder="enter your name" class="box" style="   border:none;border-radius:20px;">
     <input type="email" name="email"  required placeholder="enter your email" class="box"style="   border:none;border-radius:20px;">
     <input type="password" name="password" minlength=4 maxlength=8 required placeholder="enter your password" class="box"style="   border:none;border-radius:20px;">
     <input type="password" name="cpassword" minlength=4 maxlength=8 required placeholder="confirm your password" class="box"style="   border:none;border-radius:20px;">
     <input type="submit" name="submit" class="btn"  value="sign up">
     </form>


     </div>

     <style>
      .icon{
   font-size:20px;
border-radius:50%;
background-color:#D9AAB7;
   margin-left:20px;
   width:35px;
   height:35px;
   margin-top:10px;
   margin-bottom:10px;
   border: 1px solid #D9AAB7;
   color:#fff;
}
.icon:hover{
 
background-color:#f0f0f0;
   
   border: 1px solid #f0f0f0;
   color:#000;
}
.icon i{
padding-left: 7px;
padding-top:7px;
}

a{
   text-decoration: none;
    color: inherit;
}
  </style>

    

<script src="admin_script.js"></script>
    </body>
    </html>