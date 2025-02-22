<?php
if(isset($_GET['id']) && isset($_GET['token'])){
  require 'config.php';
  require 'function.php';
  $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
  $req->execute([$_GET['id'], $_GET['token']]);
  $user = $req->fetch();
  if($user){
   if(!empty($_POST)){
    if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
        session_start();
        $_SESSION['flash']['succes'] = 'your password has been successfully updated';
        $_SESSION['auth'] = $user;
        header('location:account.php');
        exit();
    }
   }

  }else{
    session_start();
    $_SESSION['flash']['error'] = 'This token is no longer valide';
    header('location:login.php');
    exit();

  }

}else{
    header('location:login.php');
    exit();
}




?>
























<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require 'header.php';?>
   <div class="form-container">
     <form action="" method="post">
        <h3>Reset my password</h3>
     
     
     <input type="password" name="password" minlength=4 maxlength=8 required placeholder="enter your password" class="box">
     <input type="password" name="password_confirm" minlength=4 maxlength=8 required placeholder="confirm your password" class="box">
     
    

     <button type="submit" name="submit" class="btn">Reset your password</button>
     



     </form>



   </div>
    
</body>
</html>
