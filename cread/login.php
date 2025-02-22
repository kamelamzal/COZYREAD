<?php
require 'function.php';
reconnect_from_cookie();
// session_start();
if(isset($_SESSION['auth'])){
   header('location: ../index.php');
exit();
}
if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
 require_once 'config.php';
 require_once 'function.php';
 $req = $pdo->prepare('SELECT * FROM users WHERE email = :email ') ; // AND confirmed_at IS NOT NULL
 $req->execute(['email' => $_POST['email']]);
 $user = $req->fetch();


if (password_verify($_POST['password'], $user->password)) {
    $_SESSION['auth'] = $user;
    $_SESSION['flash']['success'] = 'You are connected !';

    if ($_POST['remember']) {
        $remember_token = str_random(250);
        $pdo->prepare('UPDATE users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
        setcookie('remember', $user->id . '//' . $remember_token . sha1($user->id . 'ratonlaveurs'), time() + 60 * 60 * 24 * 7);
    }

    header('Location: ../index.php');
    exit();
} else {
    $_SESSION['flash']['danger'] = '<h5 style=" display: block;
    background: #D9AAB7;
    padding-top:7px;
    font-size: 0.8rem;
    
    color:#fff;
    text-align: center;
    width:280px;
    height:40px;
    border-radius:20px; 
    margin-left:500px;
    margin-top:30px;"> Identify or password incorrect </h5>';
    header('Location: ../cread\login.php');
    exit();
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
    <title>login</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="icon">
<a href="../index.php"><i class='bx bx-arrow-back'></i></a>
</div>
<?php require 'header.php';?>
   <div class="form-container">
     <form action="" method="post">
        <h3>login up</h3>
     
     <input type="email" name="email"  required placeholder="enter your email" class="box">
     <input type="password" name="password"  required placeholder="enter your password" class="box">
     <input type="checkbox" name="remember" value="1"/> se souvenir de moi
     
     <p class="forgot"><a href="forgot.php">forgot password?</a></p>

     <button type="submit" name="submit" class="btn"  >login up</button>
     <p>already don't have an account ? <a href="register.php">sign now </a></p>



     </form>



   </div>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&family=Rubik:wght@300;400;500;600&display=swap');

:root{
    --blue:#3498db;
    --red:#e74c3c;
    --orange:#f39c12;
    --black:#333;
    --white:#fff;
    --light-bg:#eee;
    --box-shaow:0 5px 10px rgba(0,0,0 .1);
    --border:2px solid var(var(--black));
}

*{
    font-family: 'poppins',sans-serif;
    margin:0; padding: 0;
    box-sizing: border-box;
    outline: none; border:none;
    text-decoration: none;

}

*::-webkit-scrollbar{
    width: 10px;
    height: 5px;
}
*::-webkit-scrollbar-track{
    background-color: transparent;
}

*::-webkit-scrollbar-thumb{
    background-color: var(--blue);

}

.btn,
.delete-btn,
.option-btn{
    display: inline-block;
    padding: 10px 30px;
    cursor: pointer;
    font-size: 18px;
    color: var(--white);
    border-radius: 5px;
}

.btn{
background-color: #D9AAB7;
margin-top: 10px;

}
.delete-btn{
    background-color: var(--red);
}
.option-btn{
    background-color: var(--orange);
}

.form-container{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
   

}
.form-container form{
    width: 500px;
    border-radius: 10px;
    border: var(--border);
    padding: 20px;
    text-align: center;
    background-color:#f3f3f3;
   
}

.form-container form h3{
    font-size: 30px;
    margin-bottom: 10px;
    text-transform: uppercase;
    color: var(--black);
}

.form-container form .box{
    width: 100%;
    border-radius: 5px;
    border: var(--border);
    padding: 12px 14px;
    font-size: 18px;
    margin: 10px 0;

}
.forgot{
    margin-right: 300px;
}
p{
    padding: 10px;
}



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

@media (max-width:799px){
   .form-container form{
      width: 350px;
      /* margin-bottom:390px; */
   }
    .forgot{
width:300px;
    }
 
}
    </style>
</body>
</html>
<!--  -->