<?php 
session_start();
if (isset($_SESSION['auth'])) {
  $user_id = $_SESSION['auth']->id; // logged in user id
} else {
  $user_id = false; // no login
}
?>
<?php include'cread/config.php'?>
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

<!--header-->
<header id="all">
 <!--section 1-->
    <section id="page">
        
    <div class="logo">
        <img src="logo/logoheader.png" alt="">
        <!-- <a href="#"><span>C</span>ozy <span>R</span>ead</a> -->
    </div>

    <ul id="navbar"><!--classe active pour chaque page de header-->
        <li><a href="index.php">Home</a></li>
        <!-- class="active" -->
        <li><a href="shop.php">Shop</a></li>
        <li><a href="aboutus\about.html">About Us</a></li>
        <li><a href="cread/contact.php">Contact</a></li>
        <a href="#" id="close"><i class='bx bx-x'></i></a>
    </ul>

      <div class="cat-free">
      <!--<a href="#">help</a>-->

    <?php if(isset($_SESSION['auth']))
        { 
          $user_id = $_SESSION['auth']->id; // logged in user id
    ?>
      <div id="user-btn" class="bx bx-user" ></div>
      <?php }else{ 
          $user_id = false; // no login  
      ?>
       <li > <a href="cread/login.php" ><input  style=" margin-left:-100px; "type="submit" value="Log in/Sign "></a>
      <a id="cat-fre-es" href="cread/login.php"><i class='bx bx-user' ></i></a>
      <?php } ?>

     
      </div>
      
</div>

<div class="profile">
      <?php
          $select_profile = $pdo->prepare("SELECT * FROM users WHERE id = ? ");
          $select_profile->execute([$user_id]);
          $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
       ?>
       <div id="user-btn" class="bx bx-user" ></div>
       <div style='margin:5px ;font-size:13px; text-transform:uppercase;'> <strong><?= $fetch_profile['username']; ?></strong></div>
       <div style='margin:5px 5px 10px 5px ; font-size:13px;'><strong> <?= $fetch_profile['email']; ?></strong></div>
       <a class='cat-freee' style=" width:150px; " href="cread/logout.php"   onclick="return confirm('are you sure you want to log out ?')"><input type="submit" value="Log out" ></a>
</div>
      
    </section>
    

<!--section2-->

    <section id="page2">
        <div id="mobile">
            <i  id="bar" class='bx bx-menu'></i>
              </div>
        <div class="p-1">
            <div class="menutoggle" onclick="togglemenu();"></div>
            <ul class="nav">
              <li class="newin"><a href="#books1" onclick="togglemenu();">New in</a></li>
              
                <li class="bestseller"><a href="#books" onclick="togglemenu();">Best Seller</a> </li>
                <!-- <li class="wishlist"><a href="#books" onclick="togglemenu();">Wishlist</a> </li> -->
                <li class="shop"><a href="#books">Shop now</a> </li>
            </ul>
        </div>
        <div class="p-2">
        <?php
      @include './partials/connect.php';
      $select_rows = mysqli_query($con, "SELECT * FROM `cart` ") or die('query failed');
      $row_count = mysqli_query($con, "SELECT COUNT(*) FROM `cart` WHERE user_id='$user_id'");
      $select_rows1 = mysqli_query($con, "SELECT * FROM `favoris`") or die('query failed');
      $row_count1 = mysqli_query($con, "SELECT COUNT(*) FROM `favoris` WHERE user_id='$user_id'");
      ?>
           
        </div>
       
        <div class="p-3">
           <ul style="position:relative;" >
            <li><a href="bx-shopping-bag.php"> <i class='bx bx-shopping-bag' ></i><span id="compteur-produits" style="position:absolute;top:4px;right:6px;text-align:center;font-size:8px;color:#f0f0f0; border:1px solid red;border-radius:50%;background-color:red; width:12px;height:12px; border-radius:50%"><?php echo mysqli_fetch_row($row_count)[0]; ?></span></a></li><!--kamel-->
            <li> <a href="favoris.php"> <i class='bx bx-heart'></i><span id="compteur-produits1" style="position:absolute;top:4px;right:6px;text-align:center;font-size:8px;color:#f0f0f0; border:1px solid red;border-radius:50%;background-color:red; width:12px;height:12px; border-radius:50%;"><?php echo mysqli_fetch_row($row_count1)[0]; ?></span></a></li><!--ghiles-->
           </ul>
         
        </div>
    
        </section>


<div class="sh">
<div class="container">
        <div class="icon">
            <i class='bx bx-search'></i></div>

       
        <form class="frm">
            <input type="text" placeholder="Search" id="bx-search" name='q'>
            <!-- <i class='bx bx-x'></i> -->

</form>

</div>
    </div>
    </header>
    <div class="search3">
        <?php 
        
      @include './partials/connect.php';
        
          if (isset($_GET['q'])) {
            $q = $_GET  ['q'] .'%';
            $search_resultBOOK = mysqli_query($con, "SELECT * FROM `books` where book_name LIKE '%$q'"); //On ajoute %
            $search_resultBESTSELLER = mysqli_query($con, "SELECT * FROM `bestseller` where titre_book LIKE '$q'");  //recherche des livres dans la table bestseller
            $search_resultNEWIN = mysqli_query($con, "SELECT * FROM `newin` where titre_book1 LIKE '$q'");    //recherche des livres dans la table newin
            $search_resultPromo = mysqli_query($con, "SELECT * FROM `promotion` where promo_name LIKE '$q'");    //recherche des livres dans la table promotion

            $search_cat = mysqli_query($con, "select * from books as B left join categories as C
            on (B.book_cat = C.id_cat ) where c.nom_cat LIKE '%$q'"); //pour la table books
            
            $search_cat_bestseller = mysqli_query($con, "select * from bestseller as Bt left join categories as C
            on (Bt.cat_book = C.id_cat ) where c.nom_cat LIKE '%$q'"); //pour la table bestseller

            $search_cat_newin = mysqli_query($con, "select * from newin as n left join categories as C
            on (n.cat_book = C.id_cat ) where c.nom_cat LIKE '%$q'"); //pour la table newin

            $search_cat_promo = mysqli_query($con, "select * from promotion as p left join categories as C
            on (p.promo_cat = C.id_cat ) where c.nom_cat LIKE '%$q'"); //pour la table promotion
           
            $search_auteur = mysqli_query($con, "select * from books where book_auteur LIKE '%$q'"); //auteur pour la table books
            
            $search_auteur_bestseller = mysqli_query($con, "select * from bestseller where auteur_book LIKE '%$q'"); //auteur pour la table bestseller
            
            $search_auteur_newin = mysqli_query($con, "select * from newin where auteur_book1 LIKE '%$q'"); //auteur pour la table newin
            
            $search_auteur_promo = mysqli_query($con, "select * from promotion where promo_auteur LIKE '%$q'"); //auteur pour la table promotion
           
 
           
            while ($book = mysqli_fetch_array($search_resultBOOK, MYSQLI_ASSOC)) { ?>
                <li class='search'><a href="details.php?details_id=<?=$book['book_id']; ?>"><?=$book['book_name']; ?></a></li>
            <?php }
            while ($bestseller = mysqli_fetch_array($search_resultBESTSELLER, MYSQLI_ASSOC)) { ?> 
                <li class='search'><a href="details1.php?details1_id=<?=$bestseller['Id_book']; ?>"><?=$bestseller['titre_book']; ?></a></li> 
            <?php }
            while ($newin = mysqli_fetch_array($search_resultNEWIN, MYSQLI_ASSOC)) { ?>
                <li class='search'><a href="details2.php?details2_id=<?=$newin['id_book1']; ?>"><?=$newin['titre_book1']; ?></a></li>
            <?php }

while ($promotion = mysqli_fetch_array($search_resultPromo, MYSQLI_ASSOC)) { ?>
  <li class='search'><a href="details3.php?details3_id=<?=$promotion['promo_id']; ?>"><?=$promotion['promo_name']; ?></a></li>
<?php }

            while ($book = mysqli_fetch_array($search_cat, MYSQLI_ASSOC)) { ?>
                <li class='search'><a href="details.php?details_id=<?=$book['book_id']; ?>"><?=$book['book_name']; ?></a></li>
            <?php }

            while ($bestseller = mysqli_fetch_array($search_cat_bestseller, MYSQLI_ASSOC)) { ?> 
               <li class='search'><a href="details1.php?details1_id=<?=$bestseller['Id_book']; ?>"><?=$bestseller['titre_book']; ?></a></li> 
            <?php }

            while ($newin = mysqli_fetch_array($search_cat_newin, MYSQLI_ASSOC)) { ?>
               <li class='search'><a href="details2.php?details2_id=<?=$newin['id_book1']; ?>"><?=$newin['titre_book1']; ?></a></li>
            <?php }

            
            while ($promotion = mysqli_fetch_array($search_cat_promo, MYSQLI_ASSOC)) { ?>
            <li class='search'><a href="details3.php?details3_id=<?=$promotion['promo_id']; ?>"><?=$promotion['promo_name']; ?></a></li>
            <?php }


            while ($book = mysqli_fetch_array($search_auteur, MYSQLI_ASSOC)) { ?>
              <li class='search'><a href="details.php?details_id=<?=$book['book_id']; ?>"><?=$book['book_name']; ?></a></li>
            <?php }

            while ($bestseller = mysqli_fetch_array($search_auteur_bestseller, MYSQLI_ASSOC)) { ?> 
              <li class='search'><a href="details1.php?details1_id=<?=$bestseller['Id_book']; ?>"><?=$bestseller['titre_book']; ?></a></li> 
            <?php }

            while ($newin = mysqli_fetch_array($search_auteur_newin, MYSQLI_ASSOC)) { ?>
              <li class='search'><a href="details2.php?details2_id=<?=$newin['id_book1']; ?>"><?=$newin['titre_book1']; ?></a></li>
            <?php }

while ($promotion = mysqli_fetch_array($search_auteur_promo, MYSQLI_ASSOC)) { ?>
  <li class='search'><a href="details3.php?details3_id=<?=$promotion['promo_id']; ?>"><?=$promotion['promo_name']; ?></a></li>
<?php }


}
?>
</div> 


    <style>
        
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




/*------------------------------header--------------------------------*/
#all{
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.06);
    z-index: 999;
   position: sticky;
    top: 0;
    left: 0;
  flex-wrap: wrap;
  position:relative;


}
.hide{
  display:none;
}
/* ------------------- */
.search3{

  margin-left:510px;
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
   /* display: none; */
  
}

.cat-freee input {
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
    margin-right:30px;
    
  
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
/* ------------------------ */
.p-3 ul {
    display: flex;
  position:absolute;
  left:5px;
}
/* ---------------------- */
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

   




  /* --------------------------------- */

  #page{
    position:relative;
  }
.sh{
 position:absolute;
 left:495px;
 bottom:15px;
}




 .profile{
   position: absolute;
   top:120%; right:2rem;
   text-align:center;
   background-color:  var(--white);
   border-radius: 1rem;
   box-shadow: var(--box-shadow);
   padding:20px;
   width: 15rem;
   display: none;
   animation:fadeIn .2s linear;
   z-index: 2;
  
   background-color:#fff;
}

 .profile.active{
   display: inline-block;
}
.profile p{
   color:var(--black);
   font-size: 2rem;
   margin-bottom: 1rem;
}
.bx.bx-user{
   max-width:200px;
}
#user-btn{
  color: var(--primaire);
  font-size:25px;
}



@media (max-width:799px) {
            

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
.sh{
 
  margin-left:10px;
}

/* #cat-fre-es{
   display: none;
  
} */

.cat-free input{
 

}

/* #cat-fre-es{
  display: flex;
} */
/* #cat-fre-es i{
 color: var(--noir);
 font-size: 24px;
 padding-left: 20px;
 color: var(--primaire);
} */



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
  /* .p-3 ul {
      display: flex;
      margin-right: 10px;
    margin-bottom:50px;
     
      padding: -20px;
     
   } */
   .p-3 ul {
    display: flex;
  position:absolute;
  left:10px;
}
  .p-3 li{
      position: relative;
      }
  .p-3  i{
    color: var(--primaire);
   
    padding-bottom: 30px;
  
  }    

  /* .cat-fre-es{
display: flex;
  } */
  /* .cat-fre-es i{
     color: var(--noir);
     font-size: 24px;} */



    .profile a.cat-free {

    height: 25px;
    width: 340px;
   

}
  }
    </style>
    <script >


let profile = document.querySelector('.profile');


document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () =>{
   navbar.classList.remove('active');
   profile.classList.remove('active');
}

let mainImage = document.querySelector('.update-product .image-container .main-image img');
let subImages = document.querySelectorAll('.update-product .image-container .sub-image img');

subImages.forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      mainImage.src = src;
   }
});

    </script>
 
</body>
</html>
