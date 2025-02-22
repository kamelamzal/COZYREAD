<?php

if(!empty($_POST) && !empty($_POST['email'])){
 require_once 'config.php';
 require_once 'function.php';
 $req = $pdo->prepare('SELECT * FROM users WHERE email = ? ') ;
 $req->execute([ $_POST['email']]);
 $user = $req->fetch();

if($user){
   session_start();
   $reset_token = str_random(60);
   $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id =?')->execute([$reset_token, $user->id]);
   $dest = $_POST['email'];
   $sujet = "Reset your password";
   $corp = "To reset your password please click on this link\n\nhttp://localhost/cozyread/cozyread/cread/reset.php?id={$user->id}&token=$reset_token";
   $headers = "From: cozyread6@gmail.com";
   if (mail($dest, $sujet, $corp, $headers)) {
     echo "Email sent successfully to $dest ...";
   } else {
     echo "failure to send email...";
   }
$_SESSION['flash']['success'] = ' <h5   style=" display: block;
background: #D9AAB7;
padding-top:7px;
font-size: 0.8rem;

color:#fff;
text-align: center;
width:280px;
height:40px;
border-radius:20px; 
margin-left:500px;
margin-top:30px;" >Check your G-mail compte </h5>';
header('location: login.php');
exit();

}else{
   $_SESSION['flash']['danger'] = 'No account corresponds to this mail';
}

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>forgot</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="icon">
<a href="login.php"><i class='bx bx-arrow-back'></i></a>
</div>
   <div class="form-container">
     <form action="" method="post">
        <h3>forget</h3>
     
     <input type="email" name="email"  required placeholder="enter your email" class="box">
    
      <input type="submit" name="submit" class="btn"  value="send ">
    



     </form>

     

   </div>
    <style>
      

.icon{
   font-size:20px;
border-radius:50%;
background-color:#f0f0f0;
   margin-left:20px;
   width:35px;
   height:35px;
   margin-top:10px;
   margin-bottom:10px;
   border: 1px solid #f0f0f0;
   color:#000;
}
.icon:hover{
 
background-color:#D9AAB7;
   
   border: 1px solid #D9AAB7;
   color:#fff;
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
</body>
</html>
