<?php

@include 'config.php'; 

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_desc = $_POST['product_desc'];
   $product_auteur = $_POST['product_auteur'];

   $product_category = $_POST['product_category']; //recuperer l'id de la cat selectionnée
   $product_dateedition = $_POST['product_dateedition'];
   $product_maisonedition = $_POST['product_maisonedition'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_desc) || empty($product_auteur) || empty($product_dateedition) || empty($product_maisonedition) || empty($product_image) || empty($product_category)){
      $message[] = " <h5 claase='msg' style=' display: block;
      background: #D9AAB7;
      padding-top:10px;
      font-size: 1.2rem;
      
      color:#fff;
      text-align: center;
      width:280px;
      height:40px;
      border-radius:20px; 
      margin-left:479px;
      margin-top:0px;'>please fill out all </h5>" ;  //j'ai ajouté les trucs manquants
   }else{
      $insert = "INSERT INTO newin(titre_book1, prix_book1, desc_book1, image_book1, auteur_book1, cat_book, dateedition_book1,maisonedition_book1 ) 
      VALUES('$product_name', '$product_price','$product_desc', '$product_image','$product_auteur', '$product_category', '$product_dateedition',  '$product_maisonedition' )";
   //   meme la 
     
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = " <h5 claase='msg' style=' display: block;
         background: #D9AAB7;
         padding-top:10px;
         font-size: 1.2rem;
         
         color:#fff;
         text-align: center;
         width:280px;
         height:40px;
         border-radius:20px; 
         margin-left:479px;
         margin-top:0px;'>new product added successfully </h5>";
      }else{
         $message[] = " <h5 claase='msg' style=' display: block;
         background: #D9AAB7;
         padding-top:10px;
         font-size: 1.2rem;
         
         color:#fff;
         text-align: center;
         width:280px;
         height:40px;
         border-radius:20px; 
         margin-left:479px;
         margin-top:0px;'>could not add the product </h5>";
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM newin WHERE id_book1 = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



</head>
<body>
<div class="icon">
<a href="../../../dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message. '</span>';
   }
}

?>
  
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add product to New In</h3>
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="number" placeholder="enter product price" name="product_price" class="box">
         <input type="text" name="product_desc" placeholder="enter the product decription" class="box">
         <input type="text" name="product_auteur" placeholder="enter  auteur " class="box" >


   <!-- la partie select categories -->
   <select name="product_category" class="box">
   <option value="">Select a category</option>

   <?php
   $select_query="select * from `categories`";
   $result_query=mysqli_query($conn,$select_query);
   while($row=mysqli_fetch_assoc($result_query)){
      $category_title=$row['nom_cat'];
      $category_id=$row['id_cat'];
      echo "<option value='$category_id'>$category_title</option>";
      
   }
   ?>
   </select>

   <!-- fin partie -->

         <input type="date" name="product_dateedition" placeholder="enter date of edition" class="box" required>
         <input type="text" name="product_maisonedition" placeholder="enter home of edition" class="box" required>
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product" style=" background: #D9AAB7;">
      </form>

   </div>

   <?php

$select = mysqli_query($conn, "SELECT * FROM newin");

?>
<div class="product-display">
   <table class="product-display-table">
      <thead>
      <tr>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($select)){ ?>
      <tr>
         <td><img src="img/<?php echo $row['image_book1']; ?>" height="100" alt=""></td>
         <td><?php echo $row['titre_book1']; ?></td>
         <td><?php echo $row['prix_book1']; ?>DA</td>
         <td>

            <a href="admin_update.php?edit=<?php echo $row['id_book1']; ?>" class="btn" style=" background: #D9AAB7;"> <i class="fas fa-edit"></i> edit </a>
            <a   onclick="return confirm('are you sure you want to delete this product?')" href="admin_page.php?delete=<?php echo $row['id_book1']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
         </td>
      </tr>
   <?php } ?>
   </table>
</div>

</div>
 
<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --primaire:#FF9A9E;
   --green:#27ae60;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid var(--black);
}

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
}

.btn{
   display: block;
   width: 100%;
   cursor: pointer;
   border-radius: .5rem;
   margin-top: 1rem;
   font-size: 1.7rem;
   padding:1rem 3rem;
   background: #D9AAB7;
   color:var(--white);
   text-align: center;
}

.btn:hover{
   background: var(--black);
}

.message{
   display: block;
   background: var(--bg-color);
   padding:1.5rem 1rem;
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-align: center;
}

.container{
   max-width: 1200px;
   padding:2rem;
   margin:0 auto;
}

.admin-product-form-container.centered{
   display: flex;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   
}

.admin-product-form-container form{
   max-width: 50rem;
   margin:0 auto;
   padding:2rem;
   border-radius: .5rem;
   background: var(--bg-color);
}

.admin-product-form-container form h3{
   text-transform: uppercase;
   color:var(--black);
   margin-bottom: 1rem;
   text-align: center;
   font-size: 2.5rem;
}

.admin-product-form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.5rem;
   font-size: 1.7rem;
   margin:1rem 0;
   background: var(--white);
   text-transform: none;
}

.product-display{
   margin:2rem 0;
}

.product-display .product-display-table{
   width: 100%;
   text-align: center;
}

.product-display .product-display-table thead{
   background: var(--bg-color);
}

.product-display .product-display-table th{
   padding:1rem;
   font-size: 2rem;
}


.product-display .product-display-table td{
   padding:1rem;
   font-size: 2rem;
   border-bottom: var(--border);
}

.product-display .product-display-table .btn:first-child{
   margin-top: 0;
}

.product-display .product-display-table .btn:last-child{
   background: var(--black) ;
}

.product-display .product-display-table .btn:last-child:hover{
   background:crimson ;
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



@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   .product-display{
      overflow-y:scroll;
   }

   .product-display .product-display-table{
      width: 80rem;
   }

}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

}
</style>
</body>
</html>