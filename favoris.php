<?php
// session_start();

// if (isset($_POST['action']) && $_POST['action'] == 'ajouter') {
//   // Ajoutez votre logique pour l'ajout de produit au panier ici

//   // Mettez à jour le compteur dans la session
//   $_SESSION['compteur_produits1'] = isset($_SESSION['compteur_produits1']) ? $_SESSION['compteur_produits1'] + 1 : 1;

//   // Renvoyez le nouveau compteur de produits
//   echo $_SESSION['compteur_produits1'];
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
</head>
<body>
<div class="icon">
<a href="./index.php"><i class='bx bx-arrow-back'></i></a>
</div>
<?php 
session_start();
if ( !isset( $_SESSION['auth'] ) ) {
   $user_id = false; // no login
   header('Location: cread/login.php');
   exit;
   } else {
      $user_id = $_SESSION['auth']->id; // logged in user id 
   };
?>


<!-- section6-->
<?php
@include './partials/connect.php';

if(isset($_POST['add_to_cart'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
//    $product_auteur = $_POST['product_auteur'];
   $product_quantity = 1;

   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name'");

   if(mysqli_num_rows($select_cart) != 0){
   $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(name, price, image, quantity,user_id) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity','$user_id')");
   $message[] = 'product added to cart succesfully';
   }


}


 if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `favoris` WHERE id = '$remove_id'");
  
 };

?>


 <section id="books">
        <h1>Wishlist</h1>
        <?php
    if (isset($message)) {
        echo '<div class="message"><span>'.implode(', ', $message).'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
    
       ?>
    <div id="book">
    <?php
      $select_products = mysqli_query($con, "SELECT * FROM `favoris` WHERE user_id = '$user_id'");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
        <div class="book-1">
     <form action="" method="post">
     <div class="book-img">
        <img src="img/<?php echo $fetch_product['image']; ?>" alt=""  >
            <div class="overlay">
                <!-- <button type="button" class="btn btn-secondary" title="Quick Shop"><a href="#"><i><img src="./icons/views.png" alt="" width="30px"></i></a></button> -->
                <!-- <button type="submit" class="btn btn-secondary" title="Add to Wishlist" name="add_to_favoris"><i><img src="./icons/heart.png" alt="" width="30px"></i></button> -->
                <?php if ( isset( $_SESSION['auth'] ) ) {?>
                    <!-- <button type="submit" class="btn btn-secondary" title="Add to Cart" name='add_to_cart'><a href="bx-shopping-bag.php"><i><img src="./icons/add carts.png" alt="" width="30px" ></i></a></button> -->
                <?php } else {?>
                    <a class="btn btn-secondary" href="cread/login.php">Add to Cart</a>
                <?php } ?>
            </div> 
            </div>
            <div class="book-desc">
            <h5 class=" book-desc1"><?php echo $fetch_product['name']; ?></h5>
            <h5 class=" book-desc2"><?php echo $fetch_product['auteur']; ?></h5>
            <input  type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="hidden" name="product_auteur" value="<?php echo $fetch_product['auteur']; ?>">
                <div class="book-stars">
                  <!-- <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i> -->
                </div>
             
                <p><?php echo $fetch_product['price']; ?> DA</p>
            
                <div class="book-btn">
                <a href="favoris.php?remove=<?php echo $fetch_product['id']; ?>" onclick="return confirm('remove item from cart?')" class="book-btn1"> <i class="fas fa-trash"></i> remove</a></td>
                <?php if ( isset( $_SESSION['auth'] ) ) {?>
            <a href="#" ><button id='refresh' type="submit" class="book-btn2" title="Add to Cart" name='add_to_cart' onclick="document.location.reload(false)">add to cart</button></a>
            <?php } else {?>
            <a class="book-btn2" href="cread/login.php">Add To Cart</a>
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

/*------------------------------header--------------------------------*/
#all{
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    z-index: 999;
   position: sticky;
    top: 0;
    left: 0;
  flex-wrap: wrap;
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
.message1{ 
   display: block;
   background: white;
   padding:1.5rem 1rem;
   font-size: 2rem;
   color:var(--black);
   margin-bottom: 2rem;
   text-align: center;
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
.container {
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

margin-top:50px;
font-weight: bold;
text-align: center;
position: relative;


}
#books{
    
padding-top: 20px;

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
    .book-img img, .book-img1 {
       
      
        height:180px;
        object-fit:contain;
width: 150px;
display:block;
margin-left:auto;
margin-right:auto;
margin-top:20px;
margin-bottom:10px;

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
.nav .shop,
.nav .newin,
.nav .bestseller{
    display:none;
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

.icon a{
   text-decoration: none;
    color: inherit;
}

   
.message{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 1rem;
   color:#fff;
   margin-bottom: 1rem;
   text-align: center;
   width:300px;
   height:40px;
   border-radius:20px;
  
margin-left:500px;
margin-top:30px;
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
.message{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 0.8rem;
   color:#fff;
   
   text-align: center;
   width:230px;
   height:40px;
   border-radius:20px; 
   margin-left:90px;
  
  


              /*------------------------------section1--------------------------------*/
          /* .serch .cat{
    display: none;
    
}
#page{
    padding: 0 10px;
  flex-wrap: wrap;
  
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
 */


/*--------------------------section2--------------------------------*/
  
/* #page2{
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

   .p-1 ul{
        display: flex;
        margin-top:10px;
        margin-left:20px;
        margin-right:-75px;
        
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
       font-size: 24px;} */
      
    /*------------------------------section6--------------------------------*/
     /* #book,#book1
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
        left: 190px;} */

   
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