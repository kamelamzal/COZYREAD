<?php

session_start();
if ( !isset( $_SESSION['auth'] ) ) {
   $user_id = false; // no login
   header('Location: cread/login.php');
   exit;
   } else {
      $user_id = $_SESSION['auth']->id; // logged in user id 
   }
@include './partials/connect.php';

if(isset($_POST['order_btn'])){
   
   $flat=$_POST['flat'];
   $wilaya=$_POST['wilaya'];
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $methode= $_POST['methode'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'");

   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = $product_item['price'] * $product_item['quantity'];
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($con, "INSERT INTO `commande`(name, number, email, method,delivery,street,city, country, pin_code,total_products, total_price) VALUES('$name','$number','$email','$method','$methode','$flat','$wilaya','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      $wilaya = $_POST['wilaya'];
      $method = $_POST['method'];
      $query = "SELECT * FROM delivery WHERE wilaya ='$wilaya'";
      $result = mysqli_query($con, $query);
      $shipping_cost = mysqli_fetch_assoc($result);
      if ($method === "Tarif Point Relais") {
         $Bureau = true;
      } else {
         $Domicile = true;
      }
      $shipping = isset($Bureau) ? $shipping_cost['Bureau'] : $shipping_cost['Domicile'];
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3 >thank you </h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'>total : ".$price_total ." DA  + ". $shipping ." DA of Delivery</span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span> ".$flat.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
            <p> your delivery mode : <span>".$methode. "</span> </p>
            <p>  your city : <span>".$wilaya. "</span> </p>
         </div>
            <a class='btn no-print' href='javascript:window.print()'>Download</a>
            <a href='index.php' class='btn no-print'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link href="css/style.css" rel="stylesheet" > -->

</head>
<body>



<div class="container">

<section class="checkout-form no-print">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE user_id = '$user_id'");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : <?= $grand_total; ?> DA </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="methode">
               <option value="cash on delivery" selected>cash on delivery</option>
               <option value="credit cart">credit cart</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>delivery method</span>
            <select name="method">
               <option value="Tarif Point Relais" selected>Tarif Point Relais</option>
               <option value="Tarif Domicile">Tarif Domicile</option>
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         
         <div class="inputBox">
            <span>city</span>
            <select name="wilaya">
            <option value="Adrar" selected>01-Adrar</option>
               <option value="Chlef">02-Chlef</option>
               <option value="Laghouat">03-Laghouat</option>
               <option value="Oum El Bouaghi" >04-Oum El Bouaghi</option>
               <option value="Batna">05-Batna</option>
               <option value="Bejaia">06-Bejaia</option>
               <option value="Biskra" >07-Biskra</option>
               <option value="Bechar">08-Bechar</option>
               <option value="Blida">09-Blida</option>
               <option value="Bouira" >10-Bouira</option>
               <option value="Tamenrasset">11-Tamenrasset</option>
               <option value="Tébessa">12-Tébessa</option>
               <option value="Tlemcen">13-Tlemcen</option>
               <option value="Tiaret">14-Tiaret</option>
               <option value="Tizi Ouzou">15-Tizi Ouzou</option>
               <option value="Alger">16-Alger</option>
               <option value="Djelfa">17-Djelfa</option>
               <option value="Jijel">18-Jijel</option>
               <option value="Sétif">19-sétif</option>
               <option value="Saida">20-Saida</option>
               <option value="Skikda">21-Skikda</option>
               <option value="Sidi Bel Abbés" >22-Sidi Bel Abbés</option>
               <option value="Annaba">23-Annaba</option>
               <option value="Guelma">24-Guelma</option>
               <option value="Constantine" >25-Constantine</option>
               <option value="Médéa">26-Médéa</option>
               <option value="Mostaganem">27-Mostaganem</option>
               <option value="Msila" >28-Msila</option>
               <option value="Mascara">29-Mascara</option>
               <option value="Ouargla">30-Ouargla</option>
               <option value="Oran">31-Oran</option>
               <option value="Chlef">32-EL Bayadh</option>
               <option value="Illizi">33-Illizi</option>
               <option value="Bordj Bou Arreridj">34-Bordj Bou Arreridj</option>
               <option value="Boumerdes">35-Boumerdes</option>
               <option value="Taref">36-Taref</option>
               <option value="Tindouf">37-Tindouf</option>
               <option value="Tissemsilt">38-Tissemsilt</option>
               <option value="El Oued">39-El Oued</option>
               <option value="Khenchela" >40-Khenchela</option>
               <option value="Souk Ahras">41-Souk Ahras</option>
               <option value="Tipaza">42-Tipaza</option>
               <option value="Mila" >43-Mila</option>
               <option value="Ain Defla">44-Ain Defla</option>
               <option value="Naama">45-Naama</option>
               <option value="Ain Témouchent">46-Ain Témouchent</option>
               <option value="Ghardaia">47-Ghardaia</option>
               <option value="-Relizane">48-Relizane</option>
            </select>
         </div>
        
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. algeria" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

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
   --red:#D9AAB7;
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
   padding-bottom: 5rem;
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
   padding-top:110px;
  
 
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
 
 padding-top:100px;
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
   /* margin-top:4rem; */
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
   }
  
   .display-product-table .delete-btn{
       border:1px solid #FF9A9E ;
       border-radius: 24px;
       width: 200px;
       margin-left: 55px;
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
}
 .text{
   margin-left: -320px; 
 }
 .prix{
   margin-left: -320px; 
 }
 .option-btn{
   padding:1.5rem 3rem;
   font-size: 1.7rem;
   background-color: var(--primaire);
   border-radius: 12px;
   color:var(--white);
}

     }


@media print {
   .no-print { display: none; }
} 


</style>
<!-- custom js file link  -->

<!-- custom js file link  -->
<!-- <script src="js/script.js"></script> -->
   
</body>
</html>