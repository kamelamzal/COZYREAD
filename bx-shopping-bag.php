<?php
// session_start();

// if (isset($_POST['action']) && $_POST['action'] == 'ajouter') {
//   // Ajoutez votre logique pour l'ajout de produit au panier ici

//   // Mettez à jour le compteur dans la session
//   $_SESSION['compteur_produits'] = isset($_SESSION['compteur_produits']) ? $_SESSION['compteur_produits'] + 1 : 1;

//   // Renvoyez le nouveau compteur de produits
//   echo $_SESSION['compteur_produits'];
// }
?>


<?php
session_start();
if ( !isset( $_SESSION['auth'] ) ) {
   $user_id = false; // no login
   header('Location: cread/login.php');
   exit;
   } else {
      $user_id = $_SESSION['auth']->id; // logged in user id 
   }
@include  './partials/connect.php';
if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:bx-shopping-bag.php');
   };
};


if (isset($_GET['remove'])) {
   $remove_id = $_GET['remove'];
   mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:bx-shopping-bag.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($con, "DELETE FROM `cart`");
   header('location:bx-shopping-bag.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panier</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   

</head>
<body>


<div class="container">

<section class="display-product-table">

   <h1 class="heading">My Cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

      <?php
$select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
$grand_total = 0;

if (mysqli_num_rows($select_cart) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        ?>

        <tr>
            <td><img class="image" src="img/<?php echo $fetch_cart['image']; ?>" height="160" alt=""></td>
            <td class="text"><?php echo $fetch_cart['name']; ?></td>
            <td class="prix"><?php echo number_format($fetch_cart['price']); ?>DA</td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                    <input class="number" type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                    <input type="submit" value="update" class="option-btn" name="update_update_btn">
                </form>
            </td>
            <td class="prix"><?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>DA</td>
            <td><a href="bx-shopping-bag.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
        </tr>

        <?php

        if (is_numeric($sub_total)) {
            $grand_total += $sub_total;
        }
    }
}
?>

         <tr class="table-bottom">
            <td><a href="shop.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td class="prix" colspan="3">total of all</td>
            <td class="prix"><?php echo $grand_total; ?> DA</td>
            <td><a href="bx-shopping-bag.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root{
   --blanche:#ffff;
   --noir:#222;
   --primaire:#D9AAB7;
   --gri:#b6b3b3;
   --clr1:#f0f0f0;
   --clr4:rgba(246, 200, 200, 0.2);
   
   --blue:#2980b9;
   --red:tomato;
   --orange:orange;
   --black:#333;
   --white:#fff;
   --bg-color:#eee;
   --dark-bg:rgba(0,0,0,.7);
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
   --border:.1rem solid #999;
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

.container{
   max-width: 1200px;
   margin:0 auto;
   /* padding-bottom: 5rem; */
}

section{
   padding:2rem;
}

.heading{
   text-align: center;
   font-size: 3.5rem;
   text-transform: uppercase;
   color:var(--black);
   margin-bottom: 2rem;
}

.btn,
.option-btn,
.delete-btn{
   display: block;
   width: 100%;
   text-align: center;
   background-color: var(--primaire);
   color:var(--white);
   font-size: 1.7rem;
   padding:1.2rem 3rem;
   border-radius: .5rem;
   cursor: pointer;
   margin-top: 1rem;
}

.btn:hover,
.option-btn:hover,
.delete-btn:hover{
   background-color: var(--black);
}

.option-btn i,
.delete-btn i{
   padding-right: .5rem;
}

.option-btn{
   background-color: var(--primaire);
   padding: 5px;
}

.delete-btn{
   margin-top: 0;
   background-color: var(--primaire);
}

.message{
   background-color: var(--blue);
   position: sticky;
   top:0; left:0;
   z-index: 10000;
   border-radius: .5rem;
   background-color: var(--white);
   padding:1.5rem 2rem;
   margin:0 auto;
   max-width: 1200px;
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap:1.5rem;
}

.message span{
   font-size: 2rem;
   color:var(--black);
}

.message i{
   font-size: 2.5rem;
   color:var(--black);
   cursor: pointer;
}

.message i:hover{
   color:var(--red);
}

.header{
   background-color: var(--primaire);
   position: sticky;
   top:0; left:0;
   z-index: 1000;
}

.header .flex{
   display: flex;
   align-items: center;
   padding:1.5rem 2rem;
   max-width: 1200px;
   margin:0 auto;
}

.header .flex .logo{
   margin-right: auto;
   font-size: 2.5rem;
   color:var(--white);
}

.header .flex .navbar a{
   margin-left: 2rem;
   font-size: 2rem;
   color:var(--white);
}

.header .flex .navbar a:hover{
   color:yellow;
}

.header .flex .cart{
   margin-left: 2rem;
   font-size: 2rem;
   color:var(--white);
}

.header .flex .cart:hover{
   color:yellow;
}

.header .flex .cart span{
   padding:.1rem .5rem;
   border-radius: .5rem;
   background-color: var(--white);
   color:var(--blue);
   font-size: 2rem;
}

#menu-btn{
   margin-left: 2rem;
   font-size: 3rem;
   cursor: pointer;
   color:var(--white);
   display: none;
}

.add-product-form{
   max-width: 50rem;
   background-color: var(--bg-color);
   border-radius: .5rem;
   padding:2rem;
   margin:0 auto;
   margin-top: 2rem;
}

.add-product-form h3{
   font-size: 2.5rem;
   margin-bottom: 1rem;
   color:var(--black);
   text-transform: uppercase;
   text-align: center;
}

.add-product-form .box{
   text-transform: none;
   padding:1.2rem 1.4rem;
   font-size: 1.7rem;
   color:var(--black);
   border-radius: .5rem;
   background-color: var(--white);
   margin:1rem 0;
   width: 100%;
}

.display-product-table table{
   width: 100%;
   text-align: center;
}

.display-product-table table thead th{
   padding:1.5rem;
   font-size: 2rem;
   background-color: var(--black);
   color:var(--white);
}

.display-product-table table td{
   padding:1.5rem;
   font-size: 2rem;
   color:var(--black);
 

}
.display-product-table table td .image{
 
   width: 100px;
   height: 140px;
   margin-top: 10px;
}


.display-product-table table td:first-child{
   padding:0;
}

.display-product-table table tr:nth-child(even){
   background-color: var(--bg-color);
}

.display-product-table .empty{
   margin-bottom: 2rem;
   text-align: center;
   background-color: var(--bg-color);
   color:var(--black);
   font-size: 2rem;
   padding:1.5rem;
}

.edit-form-container{
   position: fixed;
   top:0; left:0;
   z-index: 1100;
   background-color: var(--dark-bg);
   padding:2rem;
   display: none;
   align-items: center;
   justify-content: center;
   min-height: 100vh;
   width: 100%;
}

.edit-form-container form{
   width: 50rem;
   border-radius: .5rem;
   background-color: var(--white);
   text-align: center;
   padding:2rem;
}

.edit-form-container form .box{
   width: 100%;
   background-color: var(--bg-color);
   border-radius: .5rem;
   margin:1rem 0;
   font-size: 1.7rem;
   color:var(--black);
   padding:1.2rem 1.4rem;
   text-transform: none;
}

.products .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 35rem);
   gap:1.5rem;
   justify-content: center;
}

.products .box-container .box{
   text-align: center;
   padding:2rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   border-radius: .5rem;
}

.products .box-container .box img{
   height: 25rem;
}

.products .box-container .box h3{
   margin:1rem 0;
   font-size: 2.5rem;
   color:var(--black);
}

.products .box-container .box .price{
   font-size: 2.5rem;
   color:var(--black);
}

.shopping-cart table{
   text-align: center;
   width: 100%;
}

.shopping-cart table thead th{
   padding:1.5rem;
   font-size: 2rem;
   color:var(--white);
   background-color: var(--black);
}

.shopping-cart table tr td{
   border-bottom: var(--border);
   padding:1.5rem;
   font-size: 2rem;
   color:var(--black);
}

.number{
   border: 1px solid var(--gri);
   border-radius: 6px ;
   padding:4px;
   font-size:1.7rem;
   color:var(--black);
   width: 10rem;  
}
.option-btn{
   padding:.5rem 1.5rem;
   font-size: 1.7rem;
   background-color: var(--primaire);
   border-radius: 6px;
   color:var(--white);
}

.shopping-cart table input[type="submit"]:hover{
   background-color: var(--black);
}

.shopping-cart table .table-bottom{
   background-color: var(--bg-color);
}

.shopping-cart .checkout-btn{
   text-align: center;
   margin-top: 1rem;
}

.shopping-cart .checkout-btn a{
   display: inline-block;
   width: auto;
}

.shopping-cart .checkout-btn a.disabled{
   pointer-events: none;
   opacity: .5;
   user-select: none;
   background-color: var(--red);
}

.checkout-form form{
   padding:2rem;
   border-radius: .5rem;
   background-color: var(--bg-color);
}

.checkout-form form .flex{
   display: flex;
   flex-wrap: wrap;
   gap:1.5rem;
}

.checkout-form form .flex .inputBox{
   flex:1 1 40rem;
}

.checkout-form form .flex .inputBox span{
   font-size: 2rem;
   color:var(--black);
}

.checkout-form form .flex .inputBox input,
.checkout-form form .flex .inputBox select{
   width: 100%;
   background-color: var(--white);
   font-size: 1.7rem;
   color:var(--black);
   border-radius: .5rem;
   margin:1rem 0;
   padding:1.2rem 1.4rem;
   text-transform: none;
   border:var(--border);
}

.display-order{
   max-width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   text-align: center;
   padding:1.5rem;
   margin:0 auto;
   margin-bottom: 2rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
}

.display-order span{
   display: inline-block;
   border-radius: .5rem;
   background-color: var(--bg-color);
   padding:.5rem 1.5rem;
   font-size: 2rem;
   color:var(--black);
   margin:.5rem;
}

.display-order span.grand-total{
   width: 100%;
   background-color: var(--red);
   color:var(--white);
   padding:1rem;
   margin-top: 1rem;
}

.order-message-container{
   position: fixed;
   top:0; left:0;
   height: 100vh;
   overflow-y: scroll;
   overflow-x: hidden;
   padding:2rem;
   display: flex;
   align-items: center;
   justify-content: center;
   z-index: 1100;
   background-color: var(--dark-bg);
   width: 100%;
}

.order-message-container::-webkit-scrollbar{
   width: 1rem;
}

.order-message-container::-webkit-scrollbar-track{
   background-color: var(--dark-bg);
}

.order-message-container::-webkit-scrollbar-thumb{
   background-color: var(--blue);
}

.order-message-container .message-container{
   width: 50rem;
   background-color: var(--white);
   border-radius: .5rem;
   padding:2rem;
   text-align: center;
}

.order-message-container .message-container h3{
   font-size: 2.5rem;
   color:var(--black);
}

.order-message-container .message-container .order-detail{
   background-color: var(--bg-color);
   border-radius: .5rem;
   padding:1rem;
   margin:1rem 0;
}

.order-message-container .message-container .order-detail span{
   background-color: var(--white);
   border-radius: .5rem;
   color:var(--black);
   font-size: 2rem;
   display: inline-block;
   padding:1rem 1.5rem;
   margin:1rem;
}

.order-message-container .message-container .order-detail span.total{
   display: block;
   background: var(--red);
   color:var(--white);
}

.order-message-container .message-container .customer-details{
   margin:1.5rem 0;
}

.order-message-container .message-container .customer-details p{
   padding:1rem 0;
   font-size: 2rem;
   color:var(--black);
}

.order-message-container .message-container .customer-details p span{
   color:var(--blue);
   padding:0 .5rem;
   text-transform: none;
}


















/* media queries  */

@media (max-width:1200px){

   .shopping-cart{
      overflow-x: scroll;
   }

   .shopping-cart table{
      width: 120rem;
   }

   .shopping-cart .heading{
      text-align: left;
   }

   .shopping-cart .checkout-btn{
      text-align: left;
   }

}

@media (max-width:991px){

   html{
      font-size: 55%;
   }

}

@media (max-width:768px){

   #menu-btn{
      display: inline-block;
      transition: .2s linear;
   }

   #menu-btn.fa-times{
      transform: rotate(180deg);
   }

   .header .flex .navbar{
      position: absolute;
      top:99%; left:0; right:0;
      background-color: var(--blue);
      clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
      transition: .2s linear;
   }

   .header .flex .navbar.active{
      clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
   }

   .header .flex .navbar a{
      margin:2rem;
      display: block;
      text-align: center;
      font-size: 2.5rem;
   }

   .display-product-table{
      overflow-x: scroll;
   }

   .display-product-table table{
      width: 90rem;
   }

}

@media (max-width:450px){

   html{
      font-size: 50%;
   }

   .heading{
      font-size: 3rem;
   }

   .products .box-container{
      grid-template-columns: 1fr;
   }

}
  /*------------------ version mobile panier   -------------------- */

  @media (max-width:799px){
       
   tr{
      display: block;  
      border: none;
   }
   td{
       display: block;
       padding: 10px;
       margin: 20px;
       border: none;
   }
   .display-product-table .image{
      margin-top: 15px;
       width: 150px;
       height: 200px;
       margin-left: -340px;
   
       margin-top:-30px;
   }
  
   .display-product-table .delete-btn{
       border:1px solid #FF9A9E ;
       border-radius: 24px;
       width: 200px;
       margin-left: 55px;
     
       margin-top:-30px;
    
   }
   .display-product-table .delete-btn:hover{
     border:1px solid black;
     border-radius: 24px;
 }
 
 .display-product-table .option-btn{
     border:none;
     height: 35px;
     border-radius: 24px;
     width: 200px;
     margin-left: 55px;
     
 }
 th{
     display: none;
     border: none;
 }
.number{
   margin-left: -320px; 
   border: 1px solid var(--gri);
   border-radius: 16px ;
   padding: 7px;
   cursor: pointer;
   font-size: 2rem;
   color:var(--black);
 
   margin-top:-60px;
}
 .text{
   margin-left: -320px; 
   margin-top:-30px;
 }
 .prix{
   margin-left: -320px; 
  
   margin-top:-30px;
 }
 .option-btn{
   padding:1.5rem 3rem;
   font-size: 1.7rem;
   background-color: var(--primaire);
   border-radius: 12px;
   color:var(--white);
}

     }



  




   
</style>
<!-- custom js file link  -->
<script >



</script>

</body>
</html>