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




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link rel="stylesheet" href="style_dash.css">
</head>
<body>
    
<header class="header">

<section class="flex">
<a href="dashboard.php"  class="logo"> Admin <span>Panel</span></a>

<nav class="navbar">
    <a href="dashboard.php">Home</a>
    <a href="page/page.html">Products</a>
    <a href="../gerer-cat/categories.php">Categories</a>
    <a href="admin_account.php">Admins</a>
    <a href="../gerer-utilisateurs/users.php">Users</a>
    <a href="messages.php">Messages</a>
    
</nav>

<div class="icons">
    <div id="menu-btn" class="fas fa-bars"></div>
    <div id="user-btn" class="fas fa-user"></div>
</div>

<div class="profile" style="border:none;border-radius:20px;">
      <?php
          $select_profile = $pdo->prepare("SELECT * FROM admins WHERE id = ? ");
          $select_profile->execute([$admin_id]);
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
       ?>
      

  <p style="text-transform:uppercase;"> <?= $fetch_profile['name']; ?></p>
 <p> <?= $fetch_profile['email']; ?></p>
   <a href="updateprof_admin.php" class="btn"> update profile</a>

      <div class="flex-btn">
          <!-- <a href="admin_login.php" class="option-btn">login</a> -->
          <a href="admin_register.php" class="option-btn">register</a>

       </div>

 <a href="logout_admin.php" onclick="return confirm('logout from this website?')"; class="delete-btn">logout</a>

</div>

</section>



</header>
<script str="admin_script.js"></script>
</body>
</html>