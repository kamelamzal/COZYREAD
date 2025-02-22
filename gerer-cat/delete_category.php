<?php
if(isset($_GET['delete_category'])){   //geting acess to the cat id
    $delete_category=$_GET['delete_category'];
    // echo $delete_category;

    $delete_query="delete from `categories` where id_cat=$delete_category ";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo " <script>alert('Category is been deleted successfully') </script> ";
        echo " <script>window.open('./categories.php?view_categories','_self') </script> ";
    }
}





?>