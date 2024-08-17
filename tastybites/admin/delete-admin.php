<?php 

    //Include constants.php file here
    include('../config/constants.php');

    //get the ID of Admin to be deleted
    $id = $_GET['id'];

    //Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        //Query Executed Successully and Admin Deleted
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success text-center'>Admin Deleted Successfully.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to Delete Admin
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Admin. Try Again Later.</div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>