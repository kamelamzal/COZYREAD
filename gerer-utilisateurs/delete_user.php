<?php
if (isset($_GET['delete_user'])) {
    $delete_user = $_GET['delete_user'];

    // Delete related rows in the favoris table
    $delete_favoris_query = "DELETE FROM favoris WHERE user_id = $delete_user";
    $result_favoris = mysqli_query($con, $delete_favoris_query);

    $delete_cart_query = "DELETE FROM cart WHERE user_id = $delete_user";
    $result_cart = mysqli_query($con, $delete_cart_query);

    if ($result_favoris) {
        // Delete the user after successfully deleting the related rows
        $delete_query = "DELETE FROM users WHERE id = $delete_user";
        $result = mysqli_query($con, $delete_query);

        if ($result) {
            echo "<script>alert('User has been deleted successfully')</script>";
            echo "<script>window.open('users.php','_self')</script>";
        } else {
            echo "Error deleting user: " . mysqli_error($con);
        }
    } else {
        echo "Error deleting favoris: " . mysqli_error($con);
    }
}

?>