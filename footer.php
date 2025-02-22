<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!--footer-->
     <footer class="section-p1">
                    <div class="col">
                        <!-- <a class="logo"><span>C</span>ozy <span>R</span>ead</a> -->
                        <div class="logo">
                            <img src="logo/logofooter.png" alt="">
                           
                        </div>
                        
                        <h4><strong>Contact</strong></h4> 
                        <p><strong>Adresse:</strong>Rue de la liberte-Bejaia</p>
                        <p><strong>Phone:</strong>+213673888012</p>
                        <p><strong>e-mail:</strong>cozyread-06@gmail.com</p>
                        <div class="follow">
                            <h4><strong>Follow Us</strong></h4>
                            <div class="icon">
                                <i class='bx bxl-facebook-circle'></i>
                                <i class='bx bxl-instagram' ></i>
                                <i class='bx bxl-twitter' ></i>
                                <i class='bx bxl-snapchat' ></i>
        
        
                            </div>
        
                        </div>
        
        
                    </div>
        
                    <div class="col">
                      <h4><strong>About</strong></h4>
                      <a href="aboutus/about.html">About Us</a>
                      <a href="./delivery/TableauLiv.php">Delivery</a><!--ikram-->
                      <a href="Terms/terms.html">Terms and conditions</a><!--ahlem-->
                      <a href="cread/contact.php">Contact Us</a><!--ahlem-->
                    </div>
                    <div class="col">
                        <h4><strong>Links</strong></h4>
                        <a href="cread/login.php">Sign In</a><!--fait de la part de ghiles -->
                        <a href="bx-shopping-bag.php">View cart</a> <!-- panier de kamel -->
                        <a href="favoris.php">My Wishlist</a> <!-- les favories ghiles-->
                        <a href="FAQ2/faq.html">FAQ</a><!-- a la fin-->
                      </div>
        
                      
                      <div class="copyright">
                        <p>@2023, group6, Universite de Bejaia</p>
        
                      </div>
         
    </footer>
    
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
    .book-img, .book-img1{
       
      
      height:200px;
        object-fit:contain;
width: 150px;
display:block;
margin-left:auto;
margin-right:auto;

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

   
/*------------------------------footer--------------------------------*/
    footer .col{
         margin: 15px 150px; }
    footer .copyright{
        margin-top: 5px; }
}

        
    </style>
</body>
</html>