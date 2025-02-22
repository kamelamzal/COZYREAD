<?php

session_start();
if ( !isset( $_SESSION['auth'] ) ) {
   $user_id = false; // no login
   header('Location: login.php');
   exit;
   } else {

      $user_id = $_SESSION['auth']->id; // logged in user id 
   }
include 'config.php';
include '../partials/connect.php';



if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
  
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $pdo->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ?  AND message = ?");
   $select_message->execute([$name, $email,$msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $pdo->prepare("INSERT INTO `messages`(user_id, name, email, message) VALUES(?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $msg]);

      $message[] = 'sent message successfully!';

   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
   
   <!-- font awesome cdn link  -->
   
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">

</head>
<body>
   
<div class="icon">
<a href="../index.php"><i class='bx bx-arrow-back'></i></a>
</div>

<div class="container">

   <form action="" method="post">
      <h1>Send Message</h1>
      <input type="text" name="name" placeholder="enter your name" required maxlength="20" >
      <input type="email" name="email" placeholder="enter your email" required maxlength="50"  >
      <textarea name="msg" id="msg" placeholder="enter your message" cols="30" rows="10"></textarea>
      <button type="submit" value="send message" name="send" id="btn">Send</button>
   </form>
   <div class="contact-info">
        <h1>Contact info:</h1>
        <div class="info">
                <i class="fa-solid fa-location-dot"></i>
                <p>Rue de la liberte-Bejaia Algeria</p>
        </div>
        <div class="info">
                <i class="fa-solid fa-envelope"></i>
                <p>cozyread@gmail.com</p>
        </div>
        <div class="info">
                <i class="fa-solid fa-phone"></i>
                <p>0542152088</p>
        </div>
        <div class="follow">
                <a href="#" ><i class='bx bxl-facebook'></i></a>
                <a href="#"><i class='bx bxl-twitter' ></i></a>
                <a href="#" ><i class='bx bxl-instagram' ></i></a>
            </div>

    </div>

</div>


<style> 
 :root{
    --blanc: #f0f0f0;
    --clair: #fffdfd;
    --rose:#D9AAB7;
    --gris: #b6b3b3;
}
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'poppins';
    text-decoration: none;
}
.container{
    width: 100%;
    height: 100vh;
    margin-top:50px;
    margin-bottom:50px;
    /* background: var(--blanc); */
    /* backdrop-filter: blur(10px); */
    display: flex;
    align-items: center;
    justify-content: space-around;
  
   padding:80px;
  
    
}

form{
    
    display: flex;
    text-align: center;
    flex-direction: column;
    /* background: linear-gradient(45deg, #b96461,#ffa561); */
    /* background: #d8908d; */
    /* background: #ffb6c1; */
    background: var(--blanc);
    padding: 2vw 4vw;
    width: 50%;
    max-width: 450px;
    height: 100vh;
    /* border: double ; */
    border-radius: 10px;
    box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   

}
form h1{
    font-weight: 800;
    text-transform: capitalize;
    margin-bottom: 20px;
    color: var(--rose);
}
form input, form textarea{
    border: 0;
    margin: 10px;
    padding:  10px;
    outline: none;
    background: var(--clair)  ;
    border-radius: 30px;
   
}


form button{
   
    background: var(--rose);
    color: white;
    font-size: 18px;
    border: 0;
    outline: none;
    width:250px;
    height:75px;
    margin: -3px auto;
    border-radius: 30px;
  padding-top:7px;
  padding-bottom:7px;


}

.contact-info{
    /* border: double; */
    border-left: 0px;
    border-radius: 20px;
    width: 60%;
    max-width: 300px;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    /* background: #e2dfdf; */
    background: var(--blanc);
    box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
  
  
 
}
.contact-info .info{

    display: flex;
    flex-direction: row;
    padding: 5px;

}
.contact-info h1{
    padding: 10px;
    color: var(--rose);
}
.contact-info .info i{
    padding: 5px;
}
.contact-info .follow{
    /* display: flex;
    justify-content: center; */
    padding: 5px;
}
.contact-info .follow a{
    font-size: 1.5rem;
    margin:0 1rem;
    color: var(--rose);
    cursor: pointer;
    transition: .9s linear !important;
}
.contact-info .follow a:hover{
    transform: rotate(360deg);
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

@media (max-width: 850px){
    .container{
        display: flex;
        flex-direction: column-reverse;
        justify-content: space-around;
        
    }
    form{
        padding: 2vw 4vw;
        width: 450px;
        /* max-width: 400px; */
        box-shadow:none;

    }
    .contact-info{
        width: 400px;
        height: 300px;
        margin-top:210px;

}
}

@media (max-width: 500px){
    .container{
        display: flex;
        flex-direction: column-reverse;
        justify-content: space-around;
        
    }
    form{
        padding: 2vw 3vw;
        width: 380px;
        /* max-width: 400px; */
        box-shadow:none;
        margin-top:80px;

    }
    .contact-info{
        width: 280px;
        height: 300px;

}


}

/* -----------------------------the sent/error page style------------------------------- */
.box{
    display: flex;
    flex-direction: column;
    justify-content: center;
    width: 450px;
    height: 500px;
    box-shadow: 10px 10px 2px rgba(20, 1, 1, 0.5); 
    border-radius: 20px;
    background: var(--blanc);
}
.img{
    margin: 20px auto;
    border-radius: 20px;
}
img{
    border-radius: 20px;
}
.contenu{
    text-align: center;
}

@media (max-width: 500px){
   
    .box{
        width: 350px;
        padding: 20px;
    }
}
</style>

<script src="js/script.js"></script>

</body>
</html>