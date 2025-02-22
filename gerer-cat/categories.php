<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>categories management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> 
    
  
</head>
<body>
<div class="icon">
<a href="../cread/dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>
<?php
include('./connect.php');
?>
    <h1>categories management</h1>
    <div class="btn">
        <!-- adding category -->
        <a href="./categories.php?insert_category">
          <button>insert categorie</button>
        </a>



        <!-- view categories -->
        <a href="./categories.php?view_categories">
          <button>View categorie</button>
        </a>

    </div>


    <?php
    if(isset($_GET['insert_category'])){
        include('insert_categories.php');
    }

    if(isset($_GET['view_categories'])){
        include('view_categories.php');
    }

    if(isset($_GET['edit_category'])){
        include('edit_category.php');
    }

    if(isset($_GET['delete_category'])){
        include('delete_category.php');
    }
    // save point
    // if(isset($_GET['see_books'])){
    //     include('see_books.php');
    // }

?>
  
  <style>
    :root{
    --blanc: #ecece4;
    --clair: #fffdfd;
    --rose: #D9AAB7;
    --gris: #807e7e;
}
*{
    margin: 0;
    padding: 0;
    border: 0;
    box-sizing: border-box;
    font-family: 'poppins';
    text-decoration: none;
    color: black;
}

/* -------------------categories page-------------------- */
h1{
    margin:50px;
    text-align: center;
    /* color: var(--rose); */
}

a{
     display: flex;
     flex-direction: column;
    justify-content: center;
}
button{
    height: 50px;
    width: calc(30% - 6px);
    align-self: center;
    font-size: 19px;
    font-weight: 500;
    background-color: var(--rose);
    border: 0;
    border-radius: 6px;
    cursor: pointer;
}




/* -------------------insert-categories page-------------------- */
form{
    display: flex;
    flex-direction: column;
    justify-content: center;
}

a{
    padding: 10px;
}
.btn{
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.btn a{
    width: calc(30% - 6px);
}
.btn button{
    width: calc(70% - 6px);
   color:#fff;

}
.add-bar{
    align-self: center;
    margin: 40px;
    width: 500px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.add-bar input{
    align-self: center;
    height: 50px;
    width: calc(70% - 6px);
    padding-left: 20px;
    background: var(--blanc);
    border-radius: 10px;

}
#add{
    height: 50px;
    width: calc(35% - 6px);
    padding: 0;
    align-self: center;
    font-size: 19px;
    font-weight: 500;
    background-color: var(--rose);
    border: 0;
    border-radius: 6px;
    cursor: pointer;
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
   position:relative;
}
.icon:hover{
 
background-color:#D9AAB7;
   
   border: 1px solid #D9AAB7;
   color:#fff;
}
.icon i{
position: absolute;
top:7px;
right:7px;
}

a{
   text-decoration: none;
    color: inherit;
}


@media (max-width: 600px){
    .btn a{
        width: calc(60% - 6px);
    }
    .btn button{
        width: calc(80% - 6px);
    }
    .add-bar{
        flex-direction: column;
    }
    #add{
        width: calc(70% - 6px);
        margin-top: 20px;

    }
}






/* -------------------view_categories page-------------------- */

h2{
    margin-top: 30px;
    text-align: center;
    /* color: var(--rose); */
}
.sect-1{
    display: flex;
    justify-content: center;
}
table{
    align-self: center;
    width: 80%;
    margin-top: 30px;
}
th{
    background: var(--rose);
    height: 40px;
}
td{
    text-align: center;
    background: var(--blanc);
    height: 30px;
}

/* -------------------view_categories page-------------------- */





















  </style>
</body>
</html>