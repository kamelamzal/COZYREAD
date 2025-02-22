<?php
require 'config.php';
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $password = ($_POST['password']);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    $select_admin = $pdo->prepare("SELECT * FROM admins WHERE email = ? AND password = ?");
    $select_admin->execute([$email, $password]);
    

    if($select_admin->rowcount() > 0){
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        header('location:dashboard.php');

    }else{
        $message[] = 'incorrect email or password';
    }

}

?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> adminlogin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_style.css">
</head>
<body>


<?php
if(isset($message)){
    foreach($message as $message){
        echo'
        <div class="message">
    <span>'.$message.'</span>
    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
</div>

        ';
    }
}




?>






   <div class="form-container">
     <form action="" method="post">
        <h3>login up</h3>
        <!-- <p>default email = <span>admin@gmail.com</span> & password = <span>111</span></p> -->
     
     <input type="email" name="email"  required placeholder="enter your email" class="box">
     <input type="password" name="password"  required placeholder="enter your password" class="box">
     <input type="submit" name="submit" class="btn"  value="login up">
     </form>


     </div>
    
     <style>
    
.message{
    /* display: flex; */
   background: #D9AAB7;
  padding-top:9px;
   font-size: 1rem;
   color:#fff;
   margin-bottom: 1rem;
   text-align: center;
   width:250px;
   height:40px;
   border-radius:20px;
  
margin-left:500px;
margin-top:30px;
}
     </style>
    </body>
    </html>
     



 