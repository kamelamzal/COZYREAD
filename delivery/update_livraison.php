<?php

@include 'config.php';

$IdAg = $_GET['edit'];

if(isset($_POST['update_delivery'])){

    $delivery_NameAg = $_POST['delivery_NameAg'];
    $delivery_wilaya = $_POST['delivery_wilaya'];
    $delivery_Bureau = $_POST['delivery_Bureau'];
    $delivery_Domicile = $_POST['delivery_Domicile']; 
    $delivery_CodeWilaya = $_POST['delivery_CodeWilaya'];
    if(empty($delivery_wilaya) ){
       $message[] = 'please fill out all';
    }else{

      $update_data = "UPDATE delivery SET NameAg='$delivery_NameAg', wilaya='$delivery_wilaya', Bureau='$delivery_Bureau', Domicile='$delivery_Domicile' , CodeWilaya='$delivery_CodeWilaya'  WHERE IdAg = '$IdAg'";
      $upload = mysqli_query($con, $update_data);

    

   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="styleLiv.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($con, "SELECT * FROM delivery WHERE IdAg = '$IdAg'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <input type="text" class="box" name="delivery_NameAg" value="<?php echo $row['NameAg']; ?>" placeholder="enter the agency name">
      <input type="number" min="0" class="box" name="delivery_CodeWilaya" value="<?php echo $row['CodeWilaya'] ;?>" placeholder="enter the code wilaya">
      <input type="text" class="box" name="delivery_wilaya" value="<?php echo $row['wilaya']; ?>" placeholder="enter the wilaya">
      <input type="number" min="0" class="box" name="delivery_Bureau" value="<?php echo $row['Bureau'] ;?>" placeholder="enter tarif bureau">
      <input type="number" min="0" class="box" name="delivery_Domicile" value="<?php echo $row['Domicile'] ;?>" placeholder="enter tarif domicile">
      <input type="submit" value="update delivery" name="update_delivery" class="btn">
      <a href="ajout_livraison.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>