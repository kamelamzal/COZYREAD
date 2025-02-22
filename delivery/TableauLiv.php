<?php

@include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>DELIVERY TABLE</title>
    <!-- custom css file link  -->
    <link rel="stylesheet" href="">
</head>
<body>
<div class="icon">
<a href="../index.php"><i class='bx bx-arrow-back'></i></a>
<h1>Tarifs de livraison</h1>
</div>



    
   
   
<table class="table-style">

    <thead >
        <tr>
            <th>Agency Name</th>
            <th>Code Wilaya </th>
            <th>Wilaya </th>
            <th>Tarif Point Relais</th>
            <th>Tarif Domicile </th>
        </tr>
    </thead>
    <?php

   $select = mysqli_query($con, "SELECT * FROM delivery");
   
   ?>
    

    <tbody>
        <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['NameAg']; ?></td>
            <td><?php echo $row['CodeWilaya'] ;?></td>
            <td><?php echo $row['wilaya']; ?></td>
            <td><?php echo $row['Bureau']; ?>DA</td>
            <td><?php echo $row['Domicile']; ?>DA</td>
        
         </tr>
      <?php } ?>
  
</table>

<style>
    *, ::before, ::after {
    box-sizing: border-box;
    margin: 0; 
    padding: 0;
}
body {
    padding: 20px;
    font-family: Arial, serif;
    background: #fff;
    /* display: flex; */
    justify-content: center;
    align-items: center;
}

.table-style  {
    border-collapse: collapse;
    /* box-shadow: 0 5px 50px#a74761  ; */
    cursor: pointer;
    margin-top: 55px ;
    border: 2px solid #D9AAB7  ;
    margin-left:190px;

}
h1 {
    position : absolute ;
    top: 25px ;
    font-size : 30px;
    color : black ;

    /* text-decoration: underline solid #D9AAB7  ;
    text-shadow: 4px 3px 0px #fff , 9px 8px 0px rgba (0,0,0,0.15); */

}
p {
    position: absolute ;
    top : 25px ;
    color : black ; 

}
thead tr {
    background-color:#D9AAB7  ;
    color: #fff;
    text-align: left;
  
}

th, td {
    padding: 10px 15px;
    text-align: center;
}

tbody tr, td, th {
    border: 1px solid #ddd;
}

tbody tr:nth-child(even){
    background-color: #f3f3f3;
}
.icon h1{
    text-align:center;
    margin-left:400px;
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

@media screen and (max-width: 550px) {
    
  body {
    align-items: flex-start;
    border-top: 20px;
  }
  .table-style  {
    width: 100%;
    margin-top: 40px ;
    font-size: 15px;
    margin-left:0px;
 
  
  }
  .icon{
position:relative;}
h1 {
    font-size: 15px ;
   margin-bottom:30px;
 position:absolute;
  left:-250px;
}
  th, td {
    padding: 10px 7px;
   
}

}
</style>
</body>
</html>