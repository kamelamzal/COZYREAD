<?php
// fetching data from db and desplying inside the form
if(isset($_GET['edit_category'])){
    $edit_category=$_GET['edit_category'];
    // echo $edit_category; to check geting the cat id
    $get_categories="select * from `categories` where id_cat=$edit_category";
    $result=mysqli_query($con,$get_categories);
    $row=mysqli_fetch_assoc($result);
    $category_title=$row['nom_cat'];
    // echo $category_title;
}
  
// the update section
if(isset($_POST['edit_cat'])){
    $cat_title=$_POST['category_title'];

    $update_query="update `categories` set nom_cat='$cat_title' where id_cat=$edit_category";
    $result_cat=mysqli_query($con,$update_query);
    if($result_cat){
        echo " <script>alert('The category is been updated successfully')</script> ";
        echo " <script>window.open('./categories.php?view_categories','_self')</script>"; //opens the view page and replaces the update one
    }
}

?>

<form action="" method="POST">
<h1>Edit category</h1>
<label for="category_title" style="text-align:center;">Category Title</label>
<div class="add-bar">
  <input type="text" name="category_title" id="category_title" required="required" value='<?php echo $category_title;?>'>
  <input type="submit" name="edit_cat" id="add" value="Update category">
</div>
</form>