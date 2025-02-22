<?php

@include 'config.php';

if(isset($_POST['add_delivery'])){

   $delivery_NameAg = $_POST['delivery_NameAg'];
   $delivery_wilaya = $_POST['delivery_wilaya'];
   $delivery_Bureau = $_POST['delivery_Bureau'];
   $delivery_Domicile = $_POST['delivery_Domicile']; 
   $delivery_CodeWilaya = $_POST['delivery_CodeWilaya'];
   if(empty($delivery_wilaya) ){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO delivery(NameAg, wilaya, CodeWilaya, Bureau, Domicile) VALUES('$delivery_NameAg' ,'$delivery_wilaya', '$delivery_CodeWilaya', '$delivery_Bureau', '$delivery_Domicile')";
      $upload = mysqli_query($con,$insert);
      if($upload){
         $message[] = "<h5 claase='msg' style=' display: block;
         background: #D9AAB7;
         padding-top:12px;
         font-size: 1.2rem;
         
         color:#fff;
         text-align: center;
         width:280px;
         height:40px;
         border-radius:20px; 
         margin-left:480px;
         margin-top:10px;'>new delivery added successfully </h5>";
      }else{
         $message[] = "<h5 claase='msg' style=' display: block;
         background: #D9AAB7;
         padding-top:12px;
         font-size: 1.2rem;
       
         
         color:#fff;
         text-align: center;
         width:280px;
         height:40px;
         border-radius:20px; 
         margin-left:480px;
         margin-top:10px;'>could not add the delivery </h5>";
      }
   }
// 
};

if(isset($_GET['delete'])){
   $IdAg = $_GET['delete'];
   mysqli_query($con, "DELETE FROM delivery WHERE IdAg = $IdAg");
   header('location:ajout_livraison.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>DELIVERY PAGE</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="styleLiv.css">

</head>
<body>
<div class="icon">
<a href="../cread/dashboard.php"><i class='bx bx-arrow-back'></i></a>
</div>
<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new delivery</h3>
         <input type="text" placeholder="enter agency name" name="delivery_NameAg" class="box">
         <input type="text" placeholder="enter code wilaya" name="delivery_CodeWilaya" class="box">
         <input type="text" placeholder="enter wilaya" name="delivery_wilaya" class="box">
         <input type="number" placeholder="enter tarif bureau" name="delivery_Bureau" class="box">
         <input type="number" placeholder="enter tarif domicile" name="delivery_Domicile" class="box">
         <input type="submit" class="btn" name="add_delivery" value="add delivery">
      </form>

   </div>

   <?php

   $select = mysqli_query($con, "SELECT * FROM delivery");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th> agence name </th>
            <th> Code Wilaya </th>
            <th> wilaya </th>
            <th> tarif bureau </th>
            <th> tarif domicile </th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['NameAg']; ?></td>
            <td><?php echo $row['CodeWilaya'] ;?></td>
            <td><?php echo $row['wilaya']; ?></td>
            <td><?php echo $row['Bureau']; ?>DA</td>
            <td><?php echo $row['Domicile']; ?>DA</td>
            <td>
               <a href="update_livraison.php?edit=<?php echo $row['IdAg']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="ajout_livraison.php?delete=<?php echo $row['IdAg']; ?> " class="btn" onclick="return confirm('are you sure you want to delete this delivery?')";> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>


</body>
</html>