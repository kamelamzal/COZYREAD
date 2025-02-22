<?php
require 'config.php';
session_start();

 $admin_id =  $_SESSION['admin_id'];

 if(!isset($admin_id)){
    header('location:admin_login.php');
 }
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $update_email = $pdo->prepare("UPDATE admins SET email = ? WHERE  id= ?");
    $update_email->execute([$email, $admin_id]);

    $empty_password = 'a938dfdfbaa1f25ccbc39e16060f73c44e5ef0dd';
    $select_old_password = $pdo->prepare("SELECT password FROM admins WHERE id = ?");
    $select_old_password->execute([$admin_id]);
    $fetch_prev_password = $select_old_password->fetch(PDO::FETCH_ASSOC);
    $prev_password =$fetch_prev_password['password'];
    $old_password = $_POST['old_password'];
    $old_password = filter_var($old_password, FILTER_SANITIZE_STRING);
    $new_password = $_POST['new_password'];
    $new_password = filter_var( $new_password, FILTER_SANITIZE_STRING);
    $confirm_password = $_POST['confirm_password'];
    $confirm_password = filter_var( $confirm_password, FILTER_SANITIZE_STRING);

    if($old_password == $empty_password){
        $message[] = 'please enter old password';
    }elseif($old_password != $prev_password){
        $message[] = 'old password not matched!';
    }elseif($new_password != $confirm_password){
        $message[] = 'confirm password not matched!';
    }else{
        if($new_password != $empty_password){
            $update_password = $pdo->prepare("UPDATE admins SET password = ? WHERE id = ?");
            $update_password->execute([$confirm_password, $admin_id]);
            $message[] = 'password updated successfully!';
        }else{
            $message[] = 'please enter the new password!';
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
    <title> update_profile</title>
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
        <h3>update profile</h3>
        

     <input type="email" name="email"  required placeholder="enter your email" class="box" value="<?= $fetch_profile['email'];?>"  style="   border:none;">
     <input type="password" name="old_password"  required placeholder="enter your old password" class="box"  style="   border:none;">
     <input type="password" name="new_password" minlength=4 maxlength=8 required placeholder="enter your new password" class="box" style="   border:none;">
     <input type="password" name="confirm_password" minlength=4 maxlength=8 required placeholder="confirm your new password" class="box" style="   border:none;">
     <input type="submit" name="submit" class="btn"  value="update now">
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