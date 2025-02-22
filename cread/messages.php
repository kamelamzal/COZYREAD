<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $pdo->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location: messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <title>messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style_dash.css">

</head>
<body>
<?php include 'admin_header.php'; ?>
<div class="icon">
<a href="dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>


<section class="contacts">

<h1 class="heading">messages</h1>

<div class="box-container">

   <?php
      $select_messages = $pdo->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
   <p> user id : <span><?= $fetch_message['user_id']; ?></span></p>
   <p> name : <span><?= $fetch_message['name']; ?></span></p>
   <p> email : <span><?= $fetch_message['email']; ?></span></p>
   <p> message : <span><?= $fetch_message['message']; ?></span></p>
   <a href="messages.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages</p>';
      }
   ?>

</div>

</section>












<script src="admin_script.js"></script>

<style> 
    .contacts .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 33rem);
   gap:1.5rem;
   align-items: flex-start;
   justify-content: center;
  
}

.contacts .box-container .box{
   padding:2rem;
   padding-top: 1rem;
   border-radius: 3rem;
   /* border:var(--border); */
   background-color: var(--white);
   /* box-shadow: var(--box-shadow); */
   border:solid white;
  
}

.contacts .box-container .box p{
   line-height: 1.5;
   font-size: 2rem;
   color:var(--light-color);
   margin:1rem 0;
}

.contacts .box-container .box p span{
   color:var(--main-color);
}


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
.delete-btn{
   background-color:#333;
}
.delete-btn:hover{
   background-color:red;
}
    </style>
</body>
</html>