<?php 

// Include constants.php file here
include('../config/constants.php');

// Check if email is set and not empty
if(isset($_GET['email']) && !empty($_GET['email'])) {
    // Get the email of the subscriber to be deleted
    $email = mysqli_real_escape_string($conn, $_GET['email']);

    // Create SQL Query to delete subscriber
    $sql = "DELETE FROM tbl_subscriber WHERE email='$email'";

    $res = mysqli_query($conn, $sql);

    if($res==true) {
        // Query Executed Successfully and subscription Deleted
        // Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success text-center'>Subscription Removed Successfully.</div>";
        // Redirect to Manage Subscriber Page
        header('location:'.SITEURL.'admin/manage-subscriber.php');
    } else {
        // Failed to Delete subscriber
        // Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='error text-center'>Failed to Remove Subscription. Try Again Later.</div>";
        // Redirect to Manage Subscriber Page
        header('location:'.SITEURL.'admin/manage-subscriber.php');
    }
} else {
    // If email is not set or empty, redirect to Manage Subscriber Page with an error message
    $_SESSION['delete'] = "<div class='error text-center'>Invalid Request.</div>";
    header('location:'.SITEURL.'admin/manage-subscriber.php');
}

?>