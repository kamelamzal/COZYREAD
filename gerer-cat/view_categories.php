
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>categories management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
  
</head>
<body>
<h2>The categories</h2>
<div class="sect-1">
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Categorie title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $select_cat="Select * from `categories`";
        $result=mysqli_query($con,$select_cat);
        $nbr=0;
        while($row=mysqli_fetch_assoc($result)){
            $category_id=$row['id_cat'];
            $category_title=$row['nom_cat'];
            $nbr++;
?>

        <tr>
            <td style="background-color:#f0f0f0"><?php echo $nbr;?></td>
            <td style="background-color:#f0f0f0"><?php echo $category_title;?></td>
            <td style="background-color:#f0f0f0"><a href='categories.php?edit_category=<?php echo $category_id?>'><i class='bx bxs-edit'></i></a></td>
            <td style="background-color:#f0f0f0"><a onclick="return confirm('are you sure you want to delet this?')" href='categories.php?delete_category=<?php echo $category_id?>'><i class='bx bxs-trash-alt'></i></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>


</div>

<!-- save p here -->






<style>
    :root{
    --blanc: #f0f0f0;
    /* --clair: #fffdfd; */
    --rose: #D9AAB7;
    /* --gris: #807e7e; */
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
    color:#fff;
}
td{
    text-align: center;
    background:#f0f0f0;
    height: 30px;
   
}

/* -------------------view_categories page-------------------- */





















  </style>







</body>
</html>