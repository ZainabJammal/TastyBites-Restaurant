<?php 

    //Include constants.php file here
    include('../config/constants.php');

    //get the ID of Admin to be deleted
    $id = $_GET['id'];

    //Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_offer WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        //Query Executed Successully and Offer Deleted
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success text-center'>Offer Deleted Successfully.</div>";
        //Redirect to Manage Offer Page
        header('location:'.SITEURL.'admin/manage-offer.php');
    }
    else
    {
        //Failed to Delete Offer
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Offer. Try Again Later.</div>";
        //Redirect to Manage Offer Page
        header('location:'.SITEURL.'admin/manage-offer.php');
    }

?>