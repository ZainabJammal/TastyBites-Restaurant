<?php
// Include Constants File
include('../config/constants.php');

// Check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // Get the Value and Delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the physical image file if available
    if($image_name != "")
    {
        // Image is Available. So remove it
        $path = "../images/category/".$image_name;
        
        // Check if the file exists
        if(file_exists($path)) {
            $remove = unlink($path);

            // If failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                // Set the Session Message
                $_SESSION['remove'] = "<div class='error text-center'>Failed to Remove Category Image. Path: $path</div>";
                // Redirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
                // Stop the Process
                die();
            }
        } else {
            $_SESSION['remove'] = "<div class='error text-center'>Image file does not exist at path: $path</div>";
            // Redirect to Manage Category page
            header('location:'.SITEURL.'admin/manage-category.php');
            // Stop the Process
            die();
        }
    }

    // SQL Query transaction to Delete category and its food
    mysqli_begin_transaction($conn);

    $sql1 = "DELETE FROM tbl_category WHERE id=$id";
    $res1 = mysqli_query($conn, $sql1);

    $query_success = true; // Initialize query success flag

    if(!$res1){
        // Failed to delete category
        $query_success = false;
    }

    $sql2 = "DELETE FROM tbl_food WHERE category_id=$id";
    $res2 = mysqli_query($conn, $sql2);

    if(!$res2){
        // Failed to delete food
        $query_success = false;
    }

    // Transaction committed
    if($query_success){
        mysqli_commit($conn);
        $_SESSION['delete'] = "<div class='success text-center'>Category Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    // Transaction aborted
    else {
        mysqli_rollback($conn);
        $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
}
else
{
    // Redirect to Manage Category Page
    header('location:'.SITEURL.'admin/manage-category.php');
}
?>
