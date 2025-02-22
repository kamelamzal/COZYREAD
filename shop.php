<?php
// session_start();
?>
<!-- la page shop j'ai utilisé la base de donne books le liens de css est shop.css et la version mobile sur cette page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // $(document).ready(function() {
    //   $(".book-btn2").click(function() {
    //     $.ajax({
    //       url: "bx-shopping-bag.php",
    //       type: "POST",
    //       data: { action: "ajouter" },
    //       success: function(response) {
    //         $("#compteur-produits").text(response);
    //       },
    //       error: function() {
    //         console.log("Une erreur s'est produite lors de l'ajout du produit au panier.");
    //       }
    //     });
    //   });
    // });


    // $(document).ready(function() {
    //   $(".btn.btn-secondary").click(function() {
    //     $.ajax({
    //       url: "bx-shopping-bag.php",
    //       type: "POST",
    //       data: { action: "ajouter" },
    //       success: function(response) {
    //         $("#compteur-produits").text(response);
    //       },
    //       error: function() {
    //         console.log("Une erreur s'est produite lors de l'ajout du produit au panier.");
    //       }
    //     });
    //   });
    // });
    
    // // favori
    // $(document).ready(function() {
    //   $(".btn.btn-secondary").click(function() {
    //     $.ajax({
    //       url: "favoris.php",
    //       type: "POST",
    //       data: { action: "ajouter" },
    //       success: function(response) {
    //         $("#compteur-produits1").text(response);
    //       },
    //       error: function() {
    //         console.log("Une erreur s'est produite lors de l'ajout du produit au panier.");
    //       }
    //     });
    //   });
    // });



   
  </script>
   
   
</head>
<body>

<?php  include('header.php');?>
    <!--section3-->
    <section id="hero2">
        <div class="text2">
        <h2>Buy <span> your </span></h2>
     <h2> Favourite <span>Book</span> </h2>
        <h2>From <span>Here</span></h2>
        <!-- <button>Show Now</button> -->
    </div>
    <div class="imge2">

    </div>
             
        </section>



        <!--section4-->
        <section id="slider">
        <div class="txt" >
           <h1  >welcome to our store</h1></div>
          
           <div class="carousel">
            <ul class="carousel__list">
              <li class="carousel__item" data-pos="-2" >  1</li>
              <li class="carousel__item" data-pos="-1">2</li>
              <li class="carousel__item" data-pos="0">3</li>
              <li class="carousel__item" data-pos="1">4</li>
              <li class="carousel__item" data-pos="2">5</li>
          
  
              
            </ul>
          </div>

          </section>
         
        
        
        <!--section5-->
        <?php

@include './partials/connect.php';

if(isset($_POST['add_to_cart'])){
   $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
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

if(isset($_POST['add_to_favoris3'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_auteur = $_POST['product_auteur'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($con, "SELECT * FROM `favoris` WHERE name = '$product_name' AND user_id = '$user_id'");
    if(mysqli_num_rows($select_cart) != 0){
     $msg = 'product already added to wishlist';
    } else {
       $insert_product = mysqli_query($con, "INSERT INTO `favoris`(name, price, image, auteur , quantite, user_id) VALUES('$product_name', '$product_price', '$product_image','$product_auteur', '$product_quantity', '$user_id')");
     $msg = 'product added to wishlist succesfully';
    }
 }


?>


 <section id="books">
 <div class="txt2">
        <h1>shop</h1> </div>
        <?php

if(isset($message)){
    if(is_array($message)){
        $message = implode(", ", $message);
    }
   
        echo '<div class="message" ><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    $message = "";
};
if(isset($msg)){
    if(is_array($msg)){
        $msg = implode(", ", $msg);
    }
   
        echo '<div class="message" ><span>'.$msg.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    $msg = "";
};
?>


    <div id="book" >
  
    <?php
      
      $select_products = mysqli_query($con, "SELECT * FROM `books`");
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
        
       
        <div class="book-1">
     <form action="" method="post">
     <div class="book-img">
        <img src="img/<?php echo $fetch_product['book_image']; ?>" alt=""  >

            <div class="overlay">
            <button type="button" class="btn btn-secondary" title="Quick Shop"><a href="details.php?details_id=<?php echo $fetch_product['book_id'];?>"><i><img src="./icons/views.png" alt="" width="30px"></i></a></button>
            <?php if (isset($_SESSION['auth'])) {?>
                <button type="submit" class="btn btn-secondary" title="Add to Wishlist" name='add_to_favoris3'><i><img src="./icons/heart.png" alt="" width="30px"></i></button>
                <?php } else {?>
                    <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/heart.png" alt="" width="30px"></i></a>
                <?php } ?>
                <?php if (isset($_SESSION['auth'])) {?>
                    <button type="submit" class="btn btn-secondary" title="Add to Cart" name='add_to_cart'><i><img src="./icons/add carts.png" alt="" width="30px"></i></button>
                <?php } else { ?>
                <a class="btn btn-secondary" href="cread/login.php"><i><img src="./icons/add carts.png" alt="" width="30px"></i></a>
                <?php } ?>
              
            </div>
            </div>
            <div class="book-desc">
            <h5 class=" book-desc1"><?php echo $fetch_product['book_name']; ?></h5>
              <h5 class=" book-desc2"><?php echo $fetch_product['book_auteur']; ?></h5>
               
            <input  type="hidden" name="product_name" value="<?php echo $fetch_product['book_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['book_price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['book_image']; ?>">
            <input type="hidden" name="product_auteur" value="<?php echo $fetch_product['book_auteur']; ?>">
                <div class="book-stars">
                  <!-- <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i>
                  <i class="bx bxs-star checked"></i> -->
                </div>
                <p><?php echo $fetch_product['book_price']; ?> DA</p>
            
                <div class="book-btn">
            <a href="details.php?details_id=<?php echo $fetch_product['book_id'];?>" class="book-btn1" >view more</a>
                <?php if (isset($_SESSION['auth'])) {?>
            <a href="#" ><button type="submit" class="book-btn2" title="Add to Cart" name='add_to_cart'>add to cart</button></a>
              <?php } else {?>
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



/*------------------------------header--------------------------------*/
#all{
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    z-index: 999;
   position: sticky;
    top: 0;
    left: 0;
  flex-wrap: wrap;


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

/* .logo{ */
    /* font-weight: 700; */
    /* font-size: 1.3rem; */
   
  
/* } */
.logo img{
    width: 150px;
    height: 80px;
}


.logo span{
    font-size: 1.8rem;
color: var(--primaire);
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
.show_books{
    padding-top:100px;
}
/* #cat-fre-es{
  
  
} */

.cat-free input{
    padding: 5px;
    height: 30px;
    width: 140px;
    color: var(--blanche);
    background-color: var();
    border: 1px solid var(--clr1);
    border-radius: 30px;
    background-color: var(--primaire);
    cursor: pointer;
    padding-bottom: 30px;
  


}

/*------------------------------shop.php--------------------------------*/
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
.p-1 ul li a{
    text-decoration: none;
    color: var(--noir);
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
#navbar li a{
    text-decoration: none;
    color: var(--noir);
}
.nav li a{
    text-decoration: none;
    color: var(--noir);

    
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
   #hero2{
    display: flex;
    justify-content: space-between;
    background-color: var(--clr1);
    padding-bottom: 55px;
 }
 
 #hero2 .imge2{
    width: 350px;
     height: 60vh;
   /*  width: 100%;*/
   background-image: url("./img/child.png");
 
     background-size: contain;
margin-right: 160px;
margin-top: 50px;

     display: flex;
     flex-direction: column;
     align-items: flex-start;
     justify-content: center;
     background-repeat: no-repeat;
     background-color: var(--clr1);
   
     
     
 }
 #hero2 .text2{
     padding: 150px 0px 20px 200px;
   
 }
 #hero2 .text2 h2{
     font-size: 56px;
     line-height: 54px;
     color: #222;
 }
 #hero2 .text2 h2 span{
    color: var(--primaire);
 }

 
 #hero2 .text2 button{
     background-image: url("./img/button.png");
     background-color: transparent;
     color: var(--primaire);
     border: 0;
     padding: 14px 80px 14px 75px;
     background-repeat: no-repeat;
     cursor: pointer;
     font-weight: 700;
     font-size: 15px;
     margin: 30px ;
   
 }
 

/*------------------------------section4--------------------------------*/
 #slider{
    background:#fff;
  
   
 
 }

.txt {
        margin-top: 40px;
        text-align: center;
        position: relative;
    }
  
   .txt h1::after{
        content: "";
        width: 3%;
        height: 2px;
        background-color: #D9AAB7;
        position: absolute;
        bottom: -8px;
        left: 610px;
    }
.carousel {
        margin-top: 70px;
      display: flex;
      width: 100%;
      height: 100%;
      align-items: center;
      font-family: Arial;
   }
    
      .carousel__list {
        display: flex;
        list-style: none;
        position: relative;
        width: 100%;
        height: 300px;
        justify-content: center;
        perspective: 300px;
        ;
      }
      
      .carousel__item {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0px;
        width: 250px;
        height: 350px;
        border-radius: 12px;
        box-shadow: 0px 2px 8px 0px rgba(50, 50, 50, 0.5);
        position: absolute;
        transition: all .3s ease-in;
        }
        
        .carousel__item:nth-child(1) {
          background: linear-gradient(45deg, #2D35EB 0%, #904ED4 100%);
          background-image: url('./img/You Shouldn’t Have Come Here 11.jpg');
          background-repeat: no-repeat;
         background-size: cover;
        }
        .carousel__item:nth-child(2) {
          background: linear-gradient(45deg, #2D35EB 0%, #fdbb2d 100%);
          background-image: url('./img/Fractal Noise 5.jpg');
          background-repeat: no-repeat;
         background-size: cover;
        }
        .carousel__item:nth-child(3) {
          background: linear-gradient(45deg, #2D35EB 0%, #22c1c3 100%);
          background-image: url('./img/A Court of Thorns and Roses 16.jpg');
          background-repeat: no-repeat;
         background-size: cover;
        }
        .carousel__item:nth-child(4) {
          background: linear-gradient(45deg, #fdbb2d 0%, #904ED4 100%);
          background-image: url('./img/image2.jpg');
          background-repeat: no-repeat;
         background-size: cover;
        }
        .carousel__item:nth-child(5) {
          background: linear-gradient(45deg, #22c1c3 0%, #904ED4 100%);
          background-image: url('./img/A Court of Wings and Ruin 17.jpg');
         
          background-repeat: no-repeat;
         background-size: cover;
        }
       
        
        .carousel__item[data-pos="0"] {
          z-index: 5;
        }
        
        .carousel__item[data-pos="-1"],
        .carousel__item[data-pos="1"] {
          opacity: 0.7;
          filter: blur(1px) grayscale(10%);
        }
        
        .carousel__item[data-pos="-1"] {
          transform: translateX(-40%) scale(.9);
          z-index: 4;
        }
        
        .carousel__item[data-pos="1"] {
          transform: translateX(40%) scale(.9);
          z-index: 4;
        }
        
        .carousel__item[data-pos="-2"],
        .carousel__item[data-pos="2"] {
          opacity: 0.4;
          filter: blur(3px) grayscale(20%);
        }
        
        .carousel__item[data-pos="-2"] {
          transform: translateX(-70%) scale(.8);
          z-index: 3;
        }
        
        .carousel__item[data-pos="2"] {
          transform: translateX(70%) scale(.8);
          z-index: 3;
        }
        
    
   
    /* ---------------section5------------------ */
    
  
    .message{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 1rem;
   color:#fff;
   margin-bottom: 1rem;
   text-align: center;
   width:270px;
   height:40px;
   border-radius:20px;
  
margin-left:500px;
margin-top:30px;
}
 
    
        
    .txt2 {
       
        text-align: center;
        position: relative;
        
    }
  
   .txt2 h1::after{
        content: "";
        width: 3%;
        height: 2px;
        background-color: #D9AAB7;
        position: absolute;
        bottom: -8px;
        left: 610px;
    }
            #book{
                display: flex;
            justify-content: space-between;
            padding: 1px 80px;
       
           flex-wrap: wrap;
          
           width: 100%;
            }
             .book-1{
                background-color: var(--clr1);
           
            width: 18rem;
            position: relative;
            height:24rem;
          
          
           margin: 30px ;
           margin-top: 30px;
           flex-wrap: wrap;
           
                }
                .book-img img{
                  
                  height:180px;
                    object-fit:contain;
                
            width: 180px;
            display:block;
            margin-left:auto;
            margin-right:auto;
            margin-top:20px;
                }
                .book-desc .book-desc1{
                    text-align:center;
                }
                .book-desc .book-desc2{
                    text-align:center;
                    font-size:15px;
                }
                .book-stars{
                    text-align:center;
                    color:gold;
                }
                .book-1 p{
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
                #books {
                    background:#fff;
                    
                }

   #books .book-1{
 
    cursor: pointer;
   
   
    position: relative;
   border-radius: 15px;
  
 
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
#books .book-1:hover .overlay{
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
   



/*------------------------------footer--------------------------------*/
footer{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background-color: rgb(222, 216, 216);
   
    

}
footer .col{
    display: flex;
    flex-direction: column;
  margin-top: 30px;
  margin-left: 100px;
  margin-right: 130px;
    align-items: flex-start;
    
}
footer .logo img{
   margin-bottom: -35px;
  
 
 
    
}
footer h4{
 font-size: 14px;
 padding-bottom: 20px;
    
}
footer p{
    font-size: 13px;
    margin: 0 0 8px 0;
       
   }
   footer a{
    
      text-decoration: none;
      color: #222; 
    font-size: 13px;
 
    margin-bottom: 10px;
   }
   footer .follow {
    margin-top: 20px;

   }
   footer .follow i {
    color: #465b52;
    padding-right: 4px;
    cursor: pointer;
    
   }
   footer .follow i:hover,
   footer a:hover{
   color: var(--primaire);

    
  }

  
   footer .copyright{
    margin-top: 50px;
    margin-bottom: 10px;
    width: 100%;
    text-align: center;

   }
   .show_books{
    border:1px solid black;
    width:70px;
    height:150px;
    z-index:7;
   }
  
   
/*------------------------------version mobile shop--------------------------------*/
        @media (max-width:799px) {
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
  
  


}
          /*------------------------------section1--------------------------------*/
          .serch .cat{
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



/* .cat-free input{
    display: none;
  


} */

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

.p-1 ul{
        display: flex;
     
       
        position:absolute;
        bottom:-18px;
        left:160px;
        
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
        /*------------------------------section3--------------------------------*/
   
    #hero2{
        display: block;
        background-color: var(--clr1);
     }
     
     #hero2 .imge2{
        width: 350px;
         height: 45vh;
         margin-right: 20px;
      
        display: block;
        margin-left: auto;
        margin-right: auto;
         }
     
     #hero2 .text2{
         padding: 97px 0px 20px 120px;
       
     }
     #hero2 .text2 h2{
         font-size: 41px;
         line-height: 54px; }
     #hero2 .text2 button{
        
        padding: 14px 80px 14px 75px;
        font-size: 15px;
   margin-left: -25px;
  
     }
       /*------------------------------section4--------------------------------*/
       .txt {
            margin-top: 40px;
        
        }
        .txt h1::after{
          width:8%;
        bottom: -8px;
        left: 190px;
    }
     .carousel {
        margin-top: 30px;
       
     
   }
    
      .carousel__list {
        
        width: 100%;
        height: 200px;
       
        
      }
      
      .carousel__item {
       
        width: 150px;
        height: 250px;
       margin-right: 25px;
     
        }
    
 /*------------------------------section5-------------------------------*/
 .txt2 {
            margin-top: 120px;
            text-align:center;
           
            
        
        }
        .txt2 h1::after{
        width:8%;
        bottom: -8px;
        left: 250px;
    }
    #book,#book1
    {
          width:100%;
          flex-wrap:wrap;
          margin:-45px; 
        
          margin-top:15px; 
        }
         .book-btn2{
         margin-left: 10px;
           }
           #books h1::after,
           #books1 h1::after{
          width:8%;
        bottom: -8px;
        left: 190px;}

   
        
        
    
           .book-btn2{
       
               margin-left: 10px;
           }
       





       
       
       
             
     
       
        /*------------------------------footer--------------------------------*/
    footer .col{
        margin: 15px 150px; 
       
       }
        
   footer .copyright{
       margin-top: 5px; }
       footer{
        margin-top:80px;
        
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

    body{
        background:#f0f0f0;
    }
    .p-1 .newin,
    .p-1 .bestseller{
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

 





// shopp






const state = {};
const carouselList = document.querySelector('.carousel__list');
const carouselItems = document.querySelectorAll('.carousel__item');
const elems = Array.from(carouselItems);

carouselList.addEventListener('click', function (event) {
  var newActive = event.target;
  var isItem = newActive.closest('.carousel__item');

  if (!isItem || newActive.classList.contains('carousel__item_active')) {
    return;
  };
  
  update(newActive);
});

const update = function(newActive) {
  const newActivePos = newActive.dataset.pos;

  const current = elems.find((elem) => elem.dataset.pos == 0);
  const prev = elems.find((elem) => elem.dataset.pos == -1);
  const next = elems.find((elem) => elem.dataset.pos == 1);
  const first = elems.find((elem) => elem.dataset.pos == -2);
  const last = elems.find((elem) => elem.dataset.pos == 2);
  
  current.classList.remove('carousel__item_active');
  
  [current, prev, next, first, last].forEach(item => {
    var itemPos = item.dataset.pos;

    item.dataset.pos = getPos(itemPos, newActivePos)
  });
};

const getPos = function (current, active) {
  const diff = current - active;

  if (Math.abs(current - active) > 2) {
    return -current
  }

  return diff;
}














</script>
    
</body>
</html>

















