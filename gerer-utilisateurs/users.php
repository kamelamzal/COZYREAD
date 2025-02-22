<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
   
</head>
<body>
<?php
include('connect.php');
?>
<div class="icon">
<a href="../cread/dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>
<h1>Users management</h1>
<div class="sect-1">
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>User name</th>
            <th>Email</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $select_user="Select * from `users` ";
        $result=mysqli_query($con,$select_user);
        $nbr=0;
        while($row=mysqli_fetch_assoc($result)){
            $user_id=$row['id'];
            $user_fname=$row['username'];
            // $user_lname=$row['']
            $user_email=$row['email'];
            $nbr++;
?>

<tr>
            <td><?php echo $nbr;?></td>
            <td><?php echo $user_fname;?></td>
            
            <td><?php echo $user_email;?></td>
            <td><a onclick="return confirm('are you sure you want to delet this user?')" href='users.php?delete_user=<?php echo $user_id?>'><i class="fa-solid fa-trash"></i></td>
            
        </tr>
        <?php
        }
        ?>
        <?php
        if(isset($_GET['delete_user'])){
            include('delete_user.php');
        }
    ?>
    </tbody>
    </table>
  </div> 
  <style>
    :root{
   
    --rose:  #D9AAB7;
   --gris:#f0f0f0 /*  #807e7e; */
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
h1{
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
    background:var(--rose);
    height: 40px;
 color:#fff;
}
td{
    text-align: center;
    background: var(--gris);
    height: 30px;
 
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

a{
   text-decoration: none;
    color: inherit;
}

  </style> 
</body>
</html>