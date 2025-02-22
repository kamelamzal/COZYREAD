<!-- la grand fish pour les produits de newin j'ai utilise la base de donnes sous le nom newin -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>grand fish new in</title>
  
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php  include('header.php');?>

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

?>  

<?php


$id=$_GET['details2_id']; 
//  $sql = mysqli_query($con, "SELECT * FROM `books`");
//  if(mysqli_num_rows($sql) > 0){
//     while($fetch_product = mysqli_fetch_assoc($sql)){
    

    $select_products = mysqli_query($con, "SELECT * FROM `newin` where id_book1=$id");
    if(mysqli_num_rows($select_products) > 0){
       while($fetch_product = mysqli_fetch_assoc($select_products)){
        $book_catid=$fetch_product['cat_book'];
?>
<!-- recuperation de la cat -->
<?php
$requete="select nom_cat from `categories` where id_cat=$book_catid";
$cat_resultat=mysqli_query($con,$requete);
// echo $cat_resultat;
$ligne=mysqli_fetch_assoc($cat_resultat);
$category_book=$ligne['nom_cat'];

?>
 
<!-- fin -->
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" ><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<form action="" method="post">

<section id="gbook">

  <div class="gbook-img">
  <img src="img/<?php echo $fetch_product['image_book1']; ?>" alt=""  >

  </div>
  <div class="gbook-desc">
 <h2 > <strong> <?php echo $fetch_product['titre_book1']; ?> </h2></strong>
                <h5 > <?php echo $fetch_product['auteur_book1']; ?></h5>
                <input  type="hidden" name="product_name" value="<?php echo $fetch_product['titre_book1']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['prix_book1']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image_book1']; ?>">
                <p class="gbook-cat"> <?php echo $fetch_product['desc_book1']; ?></p>
                <p > <?php echo " <strong  style='color:#D9AAB7'>category:</strong> ". $category_book ?></p>   <!--afficher la cat-->
                
                 
        
                <div class="book-date">
        <strong><p class="book-date1"> <?php echo $fetch_product['maisonedition_book1']; ?></p></strong>
          <strong>  <p class="book-date2">  <?php echo $fetch_product['dateedition_book1']; ?></p></strong> 
          

           </div>
               
                
             <div class="stars " style="color:gold">
             <i class="bx bxs-star checked"></i>
             <i class="bx bxs-star checked"></i>
             <i class="bx bxs-star checked"></i>
             <i class="bx bxs-star checked"></i>
             <i class="bx bxs-star checked"></i>
           </div>
           <a class="favori"href="" style="color:red;font-size:20px;"> <i class='bx bxs-heart checked' ></i></a>
                <p class="gbook-price"> <strong>Price:</strong> <?php echo $fetch_product['prix_book1']; ?> DA</p>
              
                <?php if (isset($_SESSION['auth'])) {?>
                <a href="#" ><button type="submit" class="gbook-btn" title="Add to Cart" name='add_to_cart'>add to cart</button></a>
                <?php } else {?>
                    <a class="gbook-btn" href="cread/login.php">Add to Cart</a>
                <?php } ?>
             
  </div>
  
  <?php
         };
      };
      ?>
 
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

.message{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 1rem;
   color:#fff;
   margin-bottom: 1rem;
   text-align: center;
   width:250px;
   height:40px;
   border-radius:20px;
  
margin-left:500px;
margin-top:30px;
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

/* ----------------------- */
.p-1{
    display:none;
}

.container{
    display:none;
}


.p-3{
   
  position:absolute;
    left:950px;
    bottom:15px;
    
}
.logo  img{
    padding-top:45px;
} 
#navbar{
    padding-top:45px;
   padding-right:20px;
}
.cat-free{
    padding-top:35px;
}




*/


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
    height: 30px;
    width: 140px;
    color: var(--blanche);
    background-color: var();
    border: 1px solid black;
    border-radius: 30px;
    background-color: var(--primaire);
    cursor: pointer;
    padding-bottom: 60px;


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
    height: 30px;
    width: 140px;
    color: var(--blanche);
    background-color: var();
    border: 1px solid var(--clr1);
    border-radius: 30px;
    background-color: var(--primaire);
    cursor: pointer;
  


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
#nav li a{
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


  /*------------------------------fgrand fish details.php--------------------------------*/
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


  #gbook{
            display:flex;
            justify-content:space-between;
            margin-bottom:40px;
        
          }
          .gbook-img img{
            margin-top:60px;
            width:250px;
           
           
            height:400px;
            margin-left:190px;
            padding-bottom:20px;
            
          }
          .gbook-desc{
          width:550px;
            padding-top:40px;
            
            margin-right:70px;
            
          }
          .gbook-desc h5{
            color:#D9AAB7;
            font-size:35px;
          }
          .gbook-btn{
                  width:110px;
                  height:36px;
                   margin-right:25px;
                   border:1px solid #D9AAB7;
                   text-align:center;
                   color:white;
                   margin-top:-10px;
                   background-color:#D9AAB7;
                   border-radius:7px;
                    
                  
                    
                }
          .book-date{
                    display:flex;
                 align-items:center;
                 margin-top:-10px;
                 
                 
                 
                 
                    
                }
               
                .book-date2{
                  
                   margin-left:140px;
                    
                }
                
     

   
      

/*------------------------------version mobile  poue la grande fiche details .php--------------------------------*/
  @media (max-width:799px) {



    .message{
   display: block;
   background: var(--primaire);
  padding-top:7px;
   font-size: 0.8rem;
   color:#fff;
   margin-bottom: 1rem;
   text-align: center;
   width:180px;
   height:40px;
   border-radius:20px; 
   margin-left:115px;
   margin-top:10px;
  


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


/* ----------------------------------------------------------------- */
/*--------------------------section2--------------------------------*/
  

   .p-3{
    position:absolute;
    left:275px;
  bottom:-80px;

   }
  
   

#mobile{
    display: flex;
   
}
#mobile i{
   color: var(--noir);
   font-size: 24px;
   padding-left: 20px;
   padding-top:22px;
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
       
        left: -200px;
        background-color:var(--clr1);
        box-shadow: 0px 40px 60px rgba(0,0,0,0.1);
        
       position:relative;
        
     
       
    }
    #navbar li{
       
         position:absolute;
         top:-40px;
        
        
    }
    #navbar.active{
        left:0px;
    }
    #navbar li a.active::after,
#navbar li a:hover::after{
   
    bottom: 11px;
    left: 1px;

}
    .p-1 li a:hover::after{

    position: absolute;
    bottom: 65px;
    left: 1px;

}

    

  
  #gbook{
        display:block;
     
        position:relative;
      }
    
      .gbook-img img{
        width:250px;
        height:350px;
        margin-top: 60px;
        margin-left:80px;
       
   
       
      
       
        
       
       
      
       
        
      }
      .gbook-desc{
        width:100%;
          padding-top:20px;
       
          margin-right:70px;
        
        
          
        }
        .gbook-desc h2{
            text-align:center;
          }
        .gbook-desc h5{
            text-align:center;
          }
          .gbook-desc p{
            padding-left:15px;
            padding-right:15px;
          }
          .book-date{
                    margin-top:10px;
                 
                }
                .gbook-desc .stars{
                  text-align:center;
                }
               
                .gbook-price{
                 text-align:center;
                }
                .favori{
                  margin-left:195px;
                }
      
          .gbook-btn{
                 
                   margin-left:155px;
                    
                  
                    
                }
              
                 
   }

</style>


















<?php  include('footer.php');?>
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
</html>




