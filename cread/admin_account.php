<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $pdo->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_account.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin accounts</title>
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>
<div class="icon">
<a href="../cread/dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>
<section class="accounts">

   <h1 class="heading">admin accounts</h1>

   <div class="box-container">

   <div class="box">
      <p>add new admin</p>
      <a href="admin_register.php" class="option-btn">register admin</a>
   </div>

   <?php
      $select_accounts = $pdo->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> admin name : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
   <a href="admin_account.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('delete this account?')" class="delete-btn">delete</a>
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="updateprof_admin.php" class="option-btn">update</a>';
            }
         ?>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no accounts available!</p>';
      }
   ?>

   </div>

</section>










<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&family=Rubik:wght@300;400;500;600&display=swap');

:root{
    --blue:#3498db;
    --red:#e74c3c;
    --orange:#D9AAB7;
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
background-color:#D9AAB7;
margin-top: 10px;

}
.delete-btn{
    background-color: var(--black);
}
.delete-btn:hover{
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
    /* margin-left: 29%; */
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
background-color:#D9AAB7;
   margin-left:20px;
   width:35px;
   height:35px;
   margin-top:10px;
   margin-bottom:10px;
   border: 1px solid #f0f0f0;
   color:#fff;
}
.icon:hover{
 
background-color:#fff;
   
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


@media (max-width:799px){
   .form-container form{
      width: 350px;
   }
    .forgot{
width:300px;
    }
    .form-container{
      width:100%;
      flex-wrap:wrap;
     
}
.form-container form{
  margin-left:10px;
}

}
</style>

<script src="admin_script.js"></script>
   
</body>
</html>