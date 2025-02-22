<?php 
require('cread/config.php');
// session_start();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

//     // add button
//     $(document).ready(function() {
//       $(".book-btn2").click(function() {
//         $.ajax({
//           url: "bx-shopping-bag.php",
//           type: "POST",
//           data: { action: "ajouter" },
//           success: function(response) {
//             $("#compteur-produits").text(response);
//           },
//           error: function() {
//             console.log("Une erreur s'est produite lors de l'ajout du produit au panier.");
//           }
//         });
//       });
//     });
    



   

// // add icon

//     $(document1).ready(function() {
//       $(".btn.btn-secondary").click(function() {
//         $.ajax({
//           url: "bx-shopping-bag.php",
//           type: "POST",
//           data: { action: "ajouter" },
//           success: function(response1) {
//             $("#compteur-produits").text(response1);
//           },
//           error: function() {
//             console.log("Une erreur s'est produite lors de l'ajout du produit au panier.");
//           }
//         });
//       });
//     });


//     // favori
//     $(document2).ready(function() {
//       $(".btn.btn-secondary").click(function() {
//         $.ajax({
//           url: "favoris.php",
//           type: "POST",
//           data: { action: "ajouter" },
//           success: function(response) {
//             $("#compteur-produits1").text(response);
//           },
//           error: function() {
//             console.log("Une erreur s'est produite lors de l'ajout du produit au panier.");
//           }
//         });
//       });
//     });


  </script>
   
</head>
<body>
<?php require_once( './partials/connect.php')?>
<?php  include('header.php');?>

 <!--section3-->
    <section id="hero">
        <div class="text"> 
        <h4>Once upon a book</h4>
        <h2>Hand picked book <br>To your door</h2>
        <h2></h2>
        <h1>Adventure is just a page away....</h1>
        <p> Readers are leaders</p>
        <a href="shop.php"><button>Show Now</button></a>
    </div>
    <!-- <div class="p-1">
            <div class="menutoggle" onclick="togglemenu();"></div>
            <ul class="nav">
              <li><a href="#books1" onclick="togglemenu();" >New in</a></li>
              
                <li><a href="#books" onclick="togglemenu();">Best Seller</a> </li>
            </ul>
        </div> -->
   
    <!-- <div class="bttn" style="margin-top:160px;">
    
    <ul>

<li>    <a href="#" ><span>Best seller</span> <i></i></a> </li> <br> 
       <li> <a  href="#"  ><span>Promotion</span><i></i></a> </li> <br> 
       <li><a  href="#"   ><span>New In</span><i></i></a></li>
    </ul>
        
        

    </div>
    </div> -->
    <div class="imge">

    </div>
             
    </section>

<!--section4-->

<section id="section-p3">
    
    <div class="sec-p4">
        
        <div class="img2">
            <div class="br2">
                <h4>Books</h4>
                <p> are the plane, the train and the road. They are the defination and the journey. They are home </p>
            </div>
        </div>
    </div>
    <div class="sec-p3">
        <div class="img1">
            <div class="br1">
                <h4>   Reading</h4>
                <p>The more that you read, the more things you will know.<br> The more that you learn, the more places you will go.</p>

            </div>

        </div>
    </div>

</section>

<!--section5-->

<section id="banner" >
   
    <h2>  TO READ IS TO LIVE</h2>
    <h4>you don't Need To Disappear . All you need is a Book</h4>
    <a href="shop.php"><button class="normal">Explore More</button></a>

</section>

   <!-- section6-->

   <?php

@include './partials/connect.php';

if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");

   if(mysqli_num_rows($select_cart) != 0){
   $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(name, price, image, quantity, user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$user_id')");
   $message[] = 'product added to cart succesfully'; 
   }
}
if(isset($_POST['add_to_favoris'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_auteur = $_POST['product_auteur'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($con, "SELECT * FROM `favoris` WHERE name = '$product_name' AND user_id = '$user_id'");
    if(mysqli_num_rows($select_cart) != 0){
     $msg= 'product already added to wishlist';
    } else {
       $insert_product = mysqli_query($con, "INSERT INTO `favoris`(name, price, image, auteur, quantite, user_id) VALUES('$product_name', '$product_price', '$product_image','$product_auteur', '$product_quantity', '$user_id')");
     $msg = 'product added to wishlist succesfully';
    }
 }
?>

 <section id="books">
  
        <h1>Best Seller Book</h1>
        <?php
      if(isset($message)){
        if(is_array($message)){
            $message = implode(", ", $message);
        }
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
   if(isset($msg)){
    if(is_array($msg)){
        $msg = implode(", ", $msg);
    }
  echo '<div class="message"><span>' . $msg . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
};
?>
    <div id="book" >
    <?php
      $select_products = mysqli_query($con, "SELECT * FROM `bestseller`");
      if(mysqli_num_rows($select_products) > 0){
         while( $fetch_product = mysqli_fetch_assoc($select_products) ) {
      ?>
    <div class="book-1">
     <form action="" method="post">
     <div class="book-img">
        <img src="img/<?php echo $fetch_product['image_book']; ?>" alt="">
            <div class="overlay">
            
                <button type="button" class="btn btn-secondary" title="Quick Shop"><a href="details1.php?details1_id=<?php echo $fetch_product['Id_book'];?>"><i><img src="./icons/views.png" alt="" width="30px"></i></a></button>
                <?php if (isset($_SESSION['auth'])) {?>
                <button type="submit" class="btn btn-secondary" title="Add to Wishlist" name='add_to_favoris'><i><img src="./icons/heart.png" alt="" width="30px"></i></button>
                <?php } else {?>
                    <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/heart.png" alt="" width="30px"></i></a>
                <?php } ?>
                <?php if (isset($_SESSION['auth'])) {?>
                <button type="submit" class="btn btn-secondary" title="Add to Cart" name='add_to_cart'><i><img src="./icons/add carts.png" alt="" width="30px"></i></button>
                <?php } else {?>
                <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/add carts.png" alt="" width="30px"></i></a>
                <?php } ?>
            </div>
            </div>
            <div class="book-desc">
            <h5 class=" book-desc1"><?php echo $fetch_product['titre_book']; ?></h5>
            <h5 class=" book-desc2"><?php echo $fetch_product['auteur_book']; ?></h5>

            <input  type="hidden" name="product_name" value="<?php echo $fetch_product['titre_book']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['prix_book']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image_book']; ?>">
            <input type="hidden" name="product_auteur" value="<?php echo $fetch_product['auteur_book']; ?>">
                <div class="book-stars">
                  <!-- <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i> -->
                </div>
                <p><?php echo $fetch_product['prix_book']; ?>DA</p>
                <div class="book-btn">
            <a href="details1.php?details1_id=<?php echo $fetch_product['Id_book'];?>" class="book-btn1">view more</a>
            <?php if (isset($_SESSION['auth'])) {?>
            <a href="#" ><button type="submit" class="book-btn2" title="Add to Cart" name='add_to_cart'>add to cart</button></a>
            <?php } else { ?>
            <a class="book-btn2" href="cread/login.php">Add to Cart</a>
            <?php } ?>
         </form>
            </div>
        
        </div>         
            </div>
            <?php
         };
      };
      ?>

    </div>

  

</section>

<!-- section7-->


<?php

@include './partials/connect.php';

if(isset($_POST['add_to_cart1'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price']; 
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) != 0){
      $message1[] = 'product already added to cart ';
   }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(name, price, image, quantity, user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$user_id')");
      $message1[] = 'product added to cart succesfully  ';
     
   }

}

if(isset($_POST['add_to_favoris1'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_auteur = $_POST['product_auteur'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($con, "SELECT * FROM `favoris` WHERE name = '$product_name' AND user_id = '$user_id'");
    if(mysqli_num_rows($select_cart) != 0){
     $msg1 = 'product already added to wishlist';
    } else {
       $insert_product = mysqli_query($con, "INSERT INTO `favoris`(name, price, image, auteur , quantite, user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_auteur' , '$product_quantity', '$user_id')");
     $msg1 = 'product added to wishlist succesfully';
    }
 }


?>



 <section id="books1">
  
        <h1>New In</h1>
        <?php
 if(isset($message1)){
    if(is_array($message1)){
        $message1 = implode(", ", $message1);
    }
   
        echo '<div class="message" ><span>'.$message1.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    $message1 = "";
};
if(isset($msg1)){
    if(is_array($msg1)){
        $msg1 = implode(", ", $msg1);
    }
   
        echo '<div class="message" ><span>'.$msg1.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    $msg1 = "";
};
?>


    <div id="book1" >
  
    <?php
      
      $select_products1 = mysqli_query($con, "SELECT * FROM `newin`");
      if(mysqli_num_rows($select_products1) > 0){
         while($fetch_product1 = mysqli_fetch_assoc($select_products1)){
      ?>
        
       
        <div class="book-11">
     <form action="" method="post">
     <div class="book-img1">
        <img src="img/<?php echo $fetch_product1['image_book1']; ?>" alt=""  >

            <div class="overlay">
                <button type="button" class="btn btn-secondary" title="Quick Shop"><a href="details2.php?details2_id=<?php echo $fetch_product1['id_book1'];?>"><i><img src="./icons/views.png" alt="" width="30px"></i></a></button>
                <?php if (isset($_SESSION['auth'])) {?>
                <button type="submit" class="btn btn-secondary" title="Add to Wishlist" name='add_to_favoris1'><i><img src="./icons/heart.png" alt="" width="30px"></i></button>
                <?php } else {?>
                    <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/heart.png" alt="" width="30px"></i></a>
                <?php } ?>
                <?php if (isset($_SESSION['auth'])) {?>
                <button type="submit" class="btn btn-secondary" title="Add to Cart" name='add_to_cart1'><i><img src="./icons/add carts.png" alt="" width="30px"></i></button>
                <?php } else {?>
                <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/add carts.png" alt="" width="30px"></i></a>
                <?php } ?>
            </div>
            </div>
            <div class="book-desc1">
            <h5 class=" book-desc11"><?php echo $fetch_product1['titre_book1']; ?></h5>
              <h5 class=" book-desc21"><?php echo $fetch_product1['auteur_book1']; ?></h5>
               
            <input  type="hidden" name="product_name" value="<?php echo $fetch_product1['titre_book1']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product1['prix_book1']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product1['image_book1']; ?>">
            <input type="hidden" name="product_auteur" value="<?php echo $fetch_product1['auteur_book1']; ?>">
                <div class="book-stars1">
                  <!-- <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i> -->
                </div>
                <p><?php echo $fetch_product1['prix_book1']; ?> DA</p>
                  <div class="book-btn">
                  <a href="details2.php?details2_id=<?php echo $fetch_product1['id_book1'];?>" class="book-btn1" >view more</a>
            <?php if (isset($_SESSION['auth'])) {?>
            <a href="#" ><button type="submit" class="book-btn2" title="Add to Cart" name='add_to_cart1'>add to cart</button></a>
            <?php } else { ?>
            <a class="book-btn2" href="cread/login.php">Add to Cart</a>
            <?php } ?>
              
           
         </form>
            </div>
        
        </div>
            
            </div>
            <?php
         };
      };
      ?>

    </div>

</section>

<!-- section8 -->
<?php

@include './partials/connect.php';

if(isset($_POST['add_to_cart2'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'");
   
   if(mysqli_num_rows($select_cart) > 0){
    
      $message2[] = 'product already added to cart';
   }else{
    $message2[] = 'product added to cart succesfully';
    $insert_product = mysqli_query($con, "INSERT INTO `cart` (name, price, image, quantity, user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity', '$user_id')");
   }

}

if(isset($_POST['add_to_favoris2'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_auteur = $_POST['product_auteur'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($con, "SELECT * FROM `favoris` WHERE name = '$product_name' AND user_id = '$user_id'");
    if(mysqli_num_rows($select_cart) != 0){
     $msg2 = 'product already added to wishlist';
    } else {
       $insert_product = mysqli_query($con, "INSERT INTO `favoris`(name, price, image, auteur ,quantite, user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_auteur', '$product_quantity', '$user_id')");
     $msg2 = 'product added to wishlist succesfully';
    }
 }
?>

 <section id="books">
  
        <h1>Promotion</h1>
        <?php

if(isset($message2)){
   foreach($message2 as $message2){
      echo '<div class="message"><span>'.$message2.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};
if(isset($msg2)){
    foreach($msg2 as $msg2){
       echo '<div class="message"><span>'.$msg2.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
 };

?>


    <div id="book" >
  
    <?php
      
      $select_products2 = mysqli_query($con, "SELECT * FROM `promotion`");
      if(mysqli_num_rows($select_products2) > 0){
         while($fetch_product2 = mysqli_fetch_assoc($select_products2)){
      ?>
        
       
        <div class="book-1">
     <form action="" method="post">
     <div class="book-img">
        <img src="img/<?php echo $fetch_product2['promo_image']; ?>" alt=""  >

            <div class="overlay">
            <button type="button" class="btn btn-secondary" title="Quick Shop"><a href="details3.php?details3_id=<?php echo $fetch_product2['promo_id'];?>"><i><img src="./icons/views.png" alt="" width="30px"></i></a></button>
            <?php if (isset($_SESSION['auth'])) {?>
                <button type="submit" class="btn btn-secondary" title="Add to Wishlist" name='add_to_favoris2'><i><img src="./icons/heart.png" alt="" width="30px"></i></button>
                <?php } else {?>
                    <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/heart.png" alt="" width="30px"></i></a>
                <?php } ?>
                <?php if (isset($_SESSION['auth'])) {?>
                    <button type="submit" class="btn btn-secondary" title="Add to Cart" name='add_to_cart2'><i><img src="./icons/add carts.png" alt="" width="30px"></i></button>
                <?php } else {?>
                    <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/add carts.png" alt="" width="30px"></i></a>
                <?php } ?>
            </div>
            </div>
            <div class="book-desc">
            <h5 class=" book-desc1"><?php echo $fetch_product2['promo_name']; ?></h5>
              <h5 class=" book-desc2"><?php echo $fetch_product2['promo_auteur']; ?></h5>
               
            <input  type="hidden" name="product_name" value="<?php echo $fetch_product2['promo_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product2['promo_newprice']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product2['promo_image']; ?>">
            <input type="hidden" name="product_auteur" value="<?php echo $fetch_product2['promo_auteur']; ?>">
                <div class="book-stars">
                  <!-- <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i> -->
                </div>
                <div class="promotion" style="display:flex; justify-content:space-between; margin-left:35px;margin-right:35px;">
               <p> <s style="color:red;"><?php echo $fetch_product2['promo_oldprice']; ?> DA </s></p>
                <p><?php echo $fetch_product2['promo_newprice']; ?> DA</p>
                </div>
                <div class="book-btn">
               
                <a href="details3.php?details3_id=<?php echo $fetch_product2['promo_id'];?>" class="book-btn1" >view more</a>
                <?php if (isset($_SESSION['auth'])) {?>
            <a href="#" ><button type="submit" class="book-btn2" title="Add to Cart" name='add_to_cart2' >add to cart</button></a>
            <?php } else {?>
                <a class="book-btn2" href="cread/login.php">Add to Cart</a>
            <?php }?>
         </form>
            </div>
        
        </div>
            </div>
            <?php
         };
      };
      ?>

    </div>
</section>

 <?php  include('footer.php');?>
    <style>
        /*------------------------------all page css--------------------------------*/

@import url('https://fonts.googleapis.com/css?family=Lato:400,700');
:root{
    --blanche:#ffff;
    --noir:#222;
    --primaire:#D9AAB7; /*:#904ED4 */
    --gri:#b6b3b3;
    --clr1:#f0f0f0;
    --clr4:rgba(246, 200, 200, 0.2);
    --bg-color:#eee;

 
    
}
*,
*::before,
*::after{
    margin: 0;
    padding: 0;
    box-sizing: inherit;
}
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
    
}
ul,li{
    list-style: none;
}
a{
    text-decoration: none;
    color: inherit;
}
img{
    max-width: 100%;
}
body{
    background:#f0f0f0;
}


/*------------------------------header--------------------------------*/
#all{
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    z-index: 999;
   position: sticky;
    top: 0;
    left: 0;
  flex-wrap: wrap;


}

.message,
.message1,
.message2{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 1rem;
   color:#fff;
   margin-bottom: 1rem;
   text-align: center;
   width:280px;
   height:40px;
   border-radius:20px;
  
margin-left:500px;
margin-top:30px;
}

 

/*------------------------------section1--------------------------------*/

#page{
    height: 4rem;
    justify-content: space-between;
    display: flex;
    align-items: center;
   padding: 0 50px;
  flex-wrap: wrap;
    background-color: var(--clr1);
    
}
.container{
    width: 360px;
    height: 40px;
    border-radius: 50px;
    background: white;
    position: relative;
    overflow: hidden;
    
   

}
.container .icon{
    position: absolute;
    left: 20px;
    top: 55%;
    transform: translate(-50% , -50%);
    
    
}
.container .icon .bx-search{
    font-size: 20px;
    cursor: pointer;
    color: #444;
    
}

.container .frm{
    position: relative;
    width: 280px;
    height: 40px;
    left: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
   
}
.container .frm input{
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    border: none;
    font-size: 16px;
    outline: none;
}
.container .frm .bx-x{
    position: absolute;
    right: -35px;
    top: 50%;
    transform: translate(-50% , -50%);
    cursor: pointer;
    font-size: 20px;
    color: #8888;

    
}

.logo img{
    width: 150px;
    height: 80px;
}


.logo span{
    font-size: 1.8rem;
color: var(--primaire);
}

#cat-fre-es{
   display: none;
  
}

.cat-free input{
    padding: 5px;
    height: 25px;
    width: 140px;
    color: var(--blanche);
    background-color: var();
    border: 1px solid var(--clr1);
    border-radius: 30px;
    background-color: var(--primaire);
    cursor: pointer;
    padding-bottom: 30px;
  


}


/*------------------------------section2--------------------------------*/

#page2{
    height: 4rem;
    justify-content: space-between;
    display: flex;
    align-items: center;
   padding: 0 25px;
     background-color: var(--clr1);
     flex-wrap: wrap;
   

}
#mobile{
    display: none;
}
#close{
   display: none;
}
   
.p-1 ul{
    display: flex;
    padding-bottom:15px;
    padding-left: 20px;
  
}
.p-1 ul li{
    margin: 10px;
    position: relative;

}

.p-1 li a:hover{
    color: var(--primaire);
}
.p-1 li a:hover::after{
    content: "";
    width: 25px;
    height: 2px;
    background-color: var(--primaire);
    position: absolute;
    bottom: -4px;
    left: 1px;

}

#navbar {
    display: flex;
    align-items: center;
    justify-content: center;
    
  
}
#navbar li{
   
    margin-right: 40px;
    position: relative;
  

}
#navbar li a:hover{
    color: var(--primaire);

}
#navbar li a.active{
    color: var(--primaire)

}

#navbar li a.active::after,
#navbar li a:hover::after{
    content: "";
    width: 25px;
    height: 2px;
    background-color: var(--primaire);
    position: absolute;
    bottom: -4px;
    left: 1px;

}
.p-3 ul {
    display: flex;
 
    margin-right: 35px;
}
.p-3 li{
    position: relative;
   
}
.p-3  i{
  padding: 10px;
    color: var(--primaire);

}
.p-3 li a:hover::after{
    content: "";
    width: 15px;
    height: 2px;
    background-color: var(--primaire);
    position: absolute;
    bottom: 4px;
    left: 10px;

}






/*------------------------------section3--------------------------------*/
#hero{
   display: flex;
   justify-content: space-between;
   background-color: var(--clr1);
}

#hero .imge{
   width: 500px;
    height: 90vh;
  /*  width: 100%;*/
  background-image: url('img/book.png');
    background-size: contain;
  margin-right: 10px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    background-repeat: no-repeat;
    background-color: var(--clr1);
    
    
}
#hero .text{
    padding: 150px 0px 20px 60px;
  
}
#hero .text h2{
    font-size: 46px;
    line-height: 54px;
    color: #222;
}
#hero .text p{
 
    font-size: 16px;
    color: var(--clr3);
margin: 15px 0 20px 0;

}
#hero .text h1{
    font-size: 35px;
    line-height: 64px;
    color: var(--primaire);
}
#hero .text h6{
    font-weight: 700;
    font-size: 12px;
}
#hero .text h4{
    font-size: 20px;
    color:var(--noir);
}


#hero .text button{
    background-image: url("img/button.png");
    background-color: transparent;
    color: var(--primaire);
    border: 0;
    padding: 14px 80px 14px 65px;
    background-repeat: no-repeat;
    cursor: pointer;
    font-weight: 700;
    font-size: 15px;
  
}
/*------------------------------section4--------------------------------*/
#section-p3{
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 50px 300px;
    padding-bottom: 200px;
    background-color: var(--clr1);
    flex-wrap: wrap;
   
   
}
.sec-p3{
   flex-wrap: wrap;
    width: 300px;
    height: 400px;
}
.sec-p3 .img1{
    
    width: 300px;
    height: 400px;
    margin-top: 90px;
    background-image: url('img/book14.jpg');
    background-size: cover;
    box-shadow: 2px 2px 12px rgba(0,0,0,0.8);
    position: relative;
    border-radius: 30px;
   


}
.sec-p3 .img1 .br1{
    border: 1px solid var(--clr1);
    width: 300px;
    height: 200px;
    position: absolute;
    top: 100px;
    left: 200px;
  
    background-color: var(--clr4);
    backdrop-filter: blur(10px);
    border-radius: 15px;
}
.sec-p3 .img1 .br1 h4{
    text-align: center;
    margin: 14px;
    color: var(--primaire);
    flex-wrap: wrap;
}
.sec-p3 .img1 .br1 p{
    margin:  20px 16px;
}

.sec-p4{
    flex-wrap: wrap;
    width: 300px;
    height: 400px;
}
.sec-p4 .img2{
    width: 300px;
    height: 400px;
    margin-bottom: 30px;
    background-image: url('img/book15.jpg');
    background-size: cover;
    box-shadow: 2px 2px 12px rgba(0,0,0,0.8);
    position: relative;
    border-radius: 30px;
    flex-wrap: wrap;

}
.sec-p4 .img2 .br2{
    border: 1px solid var(--clr1);
    width: 300px;
    height: 200px;
    position: absolute;
    top: 100px;
    right: 200px;
    background-color: var(--clr4);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    
}
.sec-p4 .img2 .br2 h4{
    text-align: center;
    margin: 14px;
    color: var(--primaire);
}
.sec-p4 .img2 .br2 p{
    margin:  20px 16px;
}


/*------------------------------section5--------------------------------*/
#banner{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    background-image: url("img/b19.jpg");
    width: 100%;
    height: 45vh;
    background-size: cover;
    background-position: center;
    padding-top: 40px;
    padding-bottom: 60px;
} 
#banner h4{
    color: white;
    font-size: 16px;
    margin-bottom: 20px;

}
#banner h2{
    color: #fff;
    padding: 10px 0;
    font-size: 30px;
}
#banner h2 span{
color: var(--primaire);
}

button.normal{
    font-size: 14px;
    font-weight: 600;
    padding: 15px 30px;
    color: black;
    background-color: white;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    outline: none;
    transition: 0.2s;

}
#banner button:hover{
    background-color: var(--primaire);
    color: white;
}





/* section6 */

#book1{
    display: flex;
  
justify-content: space-between;
padding: 40px 80px;

flex-wrap: wrap;

width: 100%;


}
#book{
    display: flex;
  
justify-content: space-between;
padding: 40px 80px;

flex-wrap: wrap;

width: 100%;


}

#books h1,#books1 h1{
padding-top: 80px;
font-weight: bold;
text-align: center;
position: relative;


}
#books{
    background:#fff;
padding-top: 80px;

}

#books1{
background-color: #f0f0f0;
padding-top: 80px;


}
#books h1::after,
#books1 h1::after{
content: "";
width: 3%;
height: 2px;
background-color: #D9AAB7;
position: absolute;
bottom: -8px;
left: 610px;
}
 .book-1{
    background-color: #f0f0f0;

width: 18rem;
position: relative;
height:24rem;


margin: 30px ;
margin-top: 30px;
flex-wrap: wrap;

    }
   .book-11{
    background-color: white;

width: 18rem;
position: relative;
height:24rem;


margin: 30px ;
margin-top: 30px;
flex-wrap: wrap;

    }
    .book-img img , .book-img1 img{
       
      
      height:180px;
        object-fit:contain;
width: 150px;
display:block;
margin-left:auto;
margin-right:auto;
margin-top:20px;

    }
    .book-desc .book-desc1,
    .book-desc1 .book-desc11{
        text-align:center;
    }
    .book-desc .book-desc2,
    .book-desc1 .book-desc21{
        text-align:center;
        font-size:15px;
    }
    .book-stars,
    .book-stars1{
        text-align:center;
        color:gold;
    }
    .book-1 p,.book-11 p{
        text-align:center;
    }
   
    .book-btn{
        display:flex;
     align-items:center;
     justify-content:space-between;
     
     
        
    }
    .book-btn1{
        border:1px solid black;
       
       margin-left:25px;
       height:36px;
       width:110px;
       text-align:center;
       padding-top:5px;
       color:white;
       background-color:black;
       border-radius:7px;
        
    }
    .book-btn1:hover,
    .book-btn2:hover{
        color:white;
    }
    .book-btn2{
      width:110px;
      height:36px;
       margin-right:25px;
       border:1px solid #D9AAB7;
       text-align:center;
       color:white;
       padding-top:5px;
       background-color:#D9AAB7;
       border-radius:7px;
        
      
        
    }


    #books .book-1,
#books1 .book-11{

cursor: pointer;

position: relative;
border-radius: 15px;

margin: 30px ;
margin-top: 30px;
flex-wrap: wrap;

}
.overlay{
display: block;
opacity: 0;
position: absolute;
top: 10%;
margin-left: 0;
margin-right:100px;
width: 70px;
}
#books .book-1:hover .overlay,
#books1 .book-11:hover .overlay{
opacity: 1;
margin-left:-65px;
transition: 0.5s ease;
margin-top:25px;
}
.overlay i img{
background-color: var(--primaire);
height: 35px;
width: 35px;
font-size: 20px;
padding: 7px;
margin: 5%;
margin-right: 200px;
margin-bottom: 5%;
cursor: pointer;

}
.overlay .btn-secondary{
background: transparent !important;
border: none;
box-shadow: none;
}



   
  
    
        @media (max-width:799px) {
            .message,
            .message1,
            .message2{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 0.8rem;
   color:#fff;
   
   text-align: center;
   width:180px;
   height:40px;
   border-radius:20px; 
   margin-left:115px;
  
  


}

              /*------------------------------section1--------------------------------*/
          .serch .cat{
    display: none;
    
}
#page{
    padding: 0 10px;
  flex-wrap: wrap;
  position:relative;
  
}
.logo img{
   margin-left: 10px;
}

.container{
    width: 160px;
    height: 40px;
    border-radius: 50px;
    background: white;
    position: relative;
    overflow: hidden;
    
    margin-right:25px;
    

}
.container .icon{
    position: absolute;
    left: 20px;
    top: 55%;
    transform: translate(-50% , -50%);
  
    
}
.container .icon .bx-search{
    font-size: 20px;
    cursor: pointer;
    color: #444;
 
   
}


.container .frm{
    position: relative;
    width: 90px;
    height: 40px;
    left: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    
   }
.container .frm input{
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    border: none;
    font-size: 16px;
    outline: none;
}
.container .frm .bx-x{
    position: absolute;
    right:-30px ;
    top: 50%;
    transform: translate(-50% , -50%);
    cursor: pointer;
    font-size: 20px;
    color: #8888;

    
}


.cat-free input{
    display: none;
  


}

#cat-fre-es{
    display: flex;
}
#cat-fre-es i{
   color: var(--noir);
   font-size: 24px;
   padding-left: 20px;
   color: var(--primaire);
}



/*--------------------------section2--------------------------------*/
  
#page2{
    padding: 0px 0px 25px 0px;
   }

#mobile{
    display: flex;
   
}
#mobile i{
   color: var(--noir);
   font-size: 24px;
   padding-left: 20px;
   padding-bottom: 70px;
}
#close{
    display: initial;
    position: absolute;
    top: -46px;
    left: 60px;
    color: #222;
    font-size: 24px;
}
   
#navbar {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
        position: fixed;
        padding-left: 23px;
        height: 100vh;
        width: 100px;
        top: 129px;
        left: -200px;
        background-color:var(--clr1);
        box-shadow: 0px 40px 60px rgba(0,0,0,0.1);
        
     
       
    }
    #navbar li{
        padding-bottom: 15px;
        
    }
    #navbar.active{
        left:0px;
    }
    #navbar li a.active::after,
#navbar li a:hover::after{
   
    bottom: 11px;
    left: 1px;

}
    .p-3 li a:hover::after{
   
    bottom: 22px;
    left: 10px;

}
/* ------------------------------------- */

   .p-1 ul{
        display: flex;
     
       
        position:absolute;
        bottom:-18px;
        left:130px;
        
       }
    .p-1 ul li{
       
        position: relative;
        padding-bottom: 70px;
    }
    .p-1 li a:hover::after{

    position: absolute;
    bottom: 65px;
    left: 1px;

}
    .p-3 ul {
        display: flex;
        margin-right: -1px;
      margin-bottom:50px;
       
        padding: -20px;
       
     }
    .p-3 li{
        position: relative;
        }
    .p-3  i{
      color: var(--primaire);
     
      padding-bottom: 30px;
    
    }    

    .cat-fre-es{
 display: flex;
    }
    .cat-fre-es i{
       color: var(--noir);
       font-size: 24px;}
       #hero{
        display: block;
        background-color: var(--clr1);
     }
     
     #hero .imge{
        width: 350px;
         height: 45vh;
         margin-left: 50px;}
     #hero .text{
         padding: 37px 0px 20px 120px;
       
     }
     #hero .text h2{
         font-size: 35px;
         line-height: 54px;
         }
     #hero .text p{
       font-size: 16px;
     margin: 15px 0 20px 0;
     
     }
     #hero .text h1{
         font-size: 35px;
         line-height: 64px;
        
     }
     #hero .text h6{
         font-weight: 700;
         font-size: 12px;
     }
     #hero .text h4{
         font-size: 20px;
         margin: auto;}
     #hero .text button{
         padding: 14px 80px 14px 75px;
        font-size: 15px;
   margin-left: -25px;
        
     }
     /*------------------------------section4--------------------------------*/
      #section-p3{
       padding: 5px 10px;
         flex-wrap: wrap;}
     .sec-p3 .img1{
         width: 200px;
         height: 300px;
         margin-top: 5px;
         margin-left: 35px;
        }
     .sec-p3 .img1 .br1{
         border: 1px solid var(--primaire);
         width: 200px;
         height: 200px;
         position: absolute;
         top: 60px;
         left: 120px;}
    .sec-p4 .img2{
         width: 200px;
         height: 300px;
       margin-left: 150px;
     }
     .sec-p4 .img2 .br2{
         border: 1px solid var(--primaire);
         width: 200px;
         height: 200px;
         position: absolute;
         top: 60px;
         right: 120px;
         }
   /*------------------------------section5--------------------------------*/
    #banner{
        height: 25vh;
        padding-top: 40px;
        padding-bottom: 60px;
    }
    #banner h4{
        color: white;
        font-size: 16px;
        margin-bottom: 20px;
        margin-left: 10px;
        margin-right: 10px;
    
    }
    /*------------------------------section6--------------------------------*/
     #book,#book1
    {
          width:100%;
          flex-wrap:wrap;
          margin:-45px;  
        }
         .book-btn2{
         margin-left: 10px;
           }
           #books h1::after,
           #books1 h1::after{
          width:8%;
        bottom: -8px;
        left: 190px;}

        .p-1 .shop{
            display:none;
           }
           /* ---------------------- */
           #page{
    position:relative;
  }
.sh{
 position:absolute;
 left:105px;
 bottom:13px;



 
}



.search3{

margin-left:80px;
width:250px;
font-size:15px;
color:var(--gri);
text-align:center;
border-radius:10px;
background-color:white;
box-shadow:-1px 1px 3px var(--gri);
position:absolute;
margin-top:3px;
           

}
           }

           .p-1 .shop{
            display:none;
           }
    </style>
    
    <script >
        
const barr = document.getElementById('bar');
const closee = document.getElementById('close');
const navv = document.getElementById('navbar');

 if(barr){
    barr.addEventListener('click', () => {
        navv.classList.add('active');
    })
 }

 if(closee){
    closee.addEventListener('click', () => {
        navv.classList.remove('active');
    })
 }




 
       
</script>
</body>
•</html>