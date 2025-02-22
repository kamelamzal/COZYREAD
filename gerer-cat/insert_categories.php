<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>insert categories</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
  
</head>
<body>
<?php
if(isset($_POST['insert_cat'])){
  $category_title=$_POST['cat_title'];

  // check if the categorie doesn't exist already
  $select_query="select * from `categories` where nom_cat='$category_title'";
  $result_select=mysqli_query($con,$select_query);
  $nbr=mysqli_num_rows($result_select);
  if(empty($category_title) ){
    echo "<script>alert('Please fell out all')</script>";

    }
  else {
  if($nbr>0){
    echo "<script>alert('This category was already added')</script>";
  }else{
  $insert_query="insert into `categories` (nom_cat) values ('$category_title')";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Categorie is been added successfully')</script>";
  }
}
}}
?>

<form action="" method="POST">
<h2 style="text-align:center;margin-top:20px;">Insert category</h2>
<div class="add-bar">
  <input style="background-color:#f0f0f0" type="text" name="cat_title" placeholder="Categorie " >
  <input type="submit" id="add" name="insert_cat" value="Add the categorie">
</div>
</form>

<style>
    :root{
    --blanc: #f0f0f0;
    /* --clair: #fffdfd; */
    --clair : #f0f0f0;
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
    background-color: #f0f0f0;
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
    color:#fff;
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