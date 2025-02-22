


<?php
require_once 'function.php';
session_start();

if(!empty($_POST)){
$errors = array();
require_once 'config.php';

   
      if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['username'])){
        $errors['username'] = " <p  style='font-size:15px; border:1px solid #D9AAB7; width:350px; background-color:#D9AAB7;color:#fff;border-radius:24px; margin-bottom:10px;margin-right: 60px;'>your nickname is not valide</p>";
      }else{// verification si deja le username existe deja s'il existe on affiche le username est deja utilise
        $req = $pdo->prepare('SELECT id FROM users WHERE username=?'); //la requte de verification 
        $req->execute([$_POST['username']]); // executer la requete de verification
        $user = $req->fetch();
       if($user){
        $errors['username'] = '<p style="font-size:15px; border:1px solid #D9AAB7; width:350px; background-color:#D9AAB7;color:#fff;border-radius:24px; margin-bottom:10px;margin-right: 60px;">This username is already taken</p>';
       }
      }
     

    
      if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = " <p  style='font-size:15px; border:1px solid #D9AAB7; width:350px; background-color:#D9AAB7;color:#fff;border-radius:24px; margin-bottom:10px;margin-right: 60px;'>Your email is invalid</p>";
      }else{// verification si deja l'email existe deja s'il existe on affiche l'email est deja utilise
        $req = $pdo->prepare('SELECT id FROM users WHERE email=?'); //la requte de verification 
        $req->execute([$_POST['email']]); // executer la requete de verification
        $user = $req->fetch();
       if($user){
        $errors['email'] = '<p style="font-size:15px; border:1px solid #D9AAB7; width:350px; background-color:#D9AAB7;color:#fff;border-radius:24px; margin-bottom:10px;">This email is already in use</p>';
       }
      }
      


      if(empty($_POST['password']) || $_POST['password'] != $_POST['cpassword']){
        $errors['password'] = "<p  style='font-size:15px; border:1px solid #D9AAB7; width:350px; background-color:#D9AAB7;color:#fff;border-radius:24px; margin-bottom:10px;margin-right: 60px;'>You must enter a valid password</p>";
      }

   if(empty($errors)){
   
    $req=$pdo->prepare( "INSERT INTO users SET username = ?, password = ?, email=?, confirmation_token = ?");
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //fonction de hashage
    $token = str_random(60);
    $req->execute([$_POST['username'], $password ,$_POST['email'], $token]);
    $user_id = $pdo->lastInsertId();

    

     $dest = $_POST['email'];
     $sujet = " Test email";
     $corp = "To validate your account please click on this link\n\nhttp://localhost/cozyread/cozyread/cread/confirm.php?id=$user_id&token=$token";
     $headers = "From: cozyread6@gmail.com";
     if (mail($dest, $sujet, $corp, $headers)) {
      echo "Email sent successfully to $dest ...";
    } else {
      echo "Failed to sent email...";
     }

    


    //mail($_POST['email'], 'confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/CRead/confirm.php?id=$user_id&token=$token");


     $_SESSION['flash']['success'] = ' <p style=" display: block;
     background: #D9AAB7;
    padding-top:7px;
     font-size: 1rem;
     color:#fff;
     margin-bottom: 1rem;
     text-align: center;
     width:380px;
     height:60px;
     border-radius:20px;
    
  margin-left:450px;
  margin-top:30px;">A confirmation email has been sent to <br>you to validate your account</p>';
      
    header('location: login.php');
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
    <title>Register</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'header.php'; ?>

   <div class="form-container">

<?php if(!empty($errors)): ?>
   <div class=" alert alert-danger">
      <p style="font-size:15px; border:1px solid #D9AAB7; width:350px; background-color:#D9AAB7;color:#fff;border-radius:24px; margin-bottom:10px;">you have did'nt complete the form correctly</p>
      <ul>
      <?php foreach($errors as $error): ?>
           <li><?= $error; ?></li>
        <?php endforeach; ?>
        </ul>
   </div>
      <?php endif; ?>

    

     <form action="" method="post">
        <h3>sign up</h3>
     <input type="text" name="username"  required placeholder="enter username" class="box">
     <input type="email" name="email"  required placeholder="enter your email" class="box">
     <input type="password" name="password" minlength=4 maxlength=8 required placeholder="enter your password" class="box">
     <input type="password" name="cpassword" minlength=4 maxlength=8 required placeholder="confirm your password" class="box">
     <div class=termes><input type="checkbox" name="terms"  required> <a href="termes.php">Agree terms and condition</a> </div>
     
     <input type="submit" name="submit" class="btn"  value="sign up">
     <p>already have an account ? <a href="login.php">login now</a></p>



     </form>

    

   </div>
  

</body>
</html>