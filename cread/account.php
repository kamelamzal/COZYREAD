<?php
require 'function.php';
logged_only();

if(!empty($_POST)){
    if(empty($_POST['password']) || $_POST['password'] != $_POST['cpassword']){
        $_SESSION['flash']['danger'] = "The passwords you entered do not match";
    }else{
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'config.php';
        $req = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password, $user_id]);
        $_SESSION['flash']['success'] = "your password has been successfully updated";
    }
}





 require 'header.php';
?>








<h1>Hello! <?= $_SESSION['auth']->username; ?></h1>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
<form action="" method="post">
        <h3>update</h3>
     
     
     <input type="password" name="password"  required placeholder="enter your password" class="box">
     <input type="password" name="cpassword"  required placeholder="confirm your password" class="box">
     

     <input type="submit" name="submit" class="btn"  value="update">
     

     </form>
     </div>
    
</body>
</html>




<?php require 'footer.php'; ?>