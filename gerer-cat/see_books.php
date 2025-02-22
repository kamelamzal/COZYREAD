<?php
include('./connect.php');
$show_query="select books.titre from books ;" ;
$result=mysqli_query($con,$show_query);
echo $result;

<td><a href='see_books.php?category=<?php echo $category_id?>'><?php echo $category_title;?></a></td>
           
?>