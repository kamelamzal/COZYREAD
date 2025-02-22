<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style_dash.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p style="text-transform:uppercase;"><?= $fetch_profile['name']; ?></p>
         <a href="updateprof_admin.php" class="btn">update profile</a>
      </div>

      <div class="box">
         <?php
            $select_products = $pdo->prepare("SELECT * FROM `books`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="page/admin_shop/admin _page_shop/admin_page.php" class="btn">see Shop</a>
      </div>

      <div class="box">
         <?php
            $select_products = $pdo->prepare("SELECT * FROM `bestseller`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="./page/admin_bestseller/admin_bestseller/admin_page.php" class="btn">see Bestseller</a>
      </div>

      <div class="box">
         <?php
            $select_products = $pdo->prepare("SELECT * FROM `newin`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="./page/admin_newin/admin_newin/admin_page.php" class="btn">see New in</a>
      </div>

      <div class="box">
         <?php
            $select_products = $pdo->prepare("SELECT * FROM `promotion`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>products added</p>
         <a href="./page/admin_promotion/admin_promotion/admin_page.php" class="btn">see promotion</a>
      </div>

      <div class="box">
         <?php
            $select_users = $pdo->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
         <h3><?= $number_of_users; ?></h3>
         <p>normal users</p>
         <a href="../gerer-utilisateurs/users.php" class="btn">see users</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $pdo->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
         <h3><?= $number_of_admins; ?></h3>
         <p>admin users</p>
         <a href="admin_account.php" class="btn">see admins</a>
      </div>

      <div class="box">
         <?php
            $select_products = $pdo->prepare("SELECT * FROM `delivery`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
         <h3><?= $number_of_products; ?></h3>
         <p>delivery added</p>
         <a href="../delivery/ajout_livraison.php" class="btn">see delivery</a>
      </div>

     

   </div>

</section>












<script src="admin_script.js"></script>
   
</body>
</html>