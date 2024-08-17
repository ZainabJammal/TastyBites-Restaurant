<?php 

// Include constants.php file here
include('../config/constants.php');

// Get the ID of the customer to be deleted
$id = $_GET['id'];

// Initialize query success flag
$query_success = true;

// Query transaction to delete customer and orders
mysqli_begin_transaction($conn);

$sql1 = "DELETE FROM tbl_order WHERE customer_id=$id";
$res1 = mysqli_query($conn, $sql1);

if(!$res1){
    // Failed to delete customer's orders
    $query_success = false;
}

$sql2 = "DELETE FROM tbl_customer WHERE id=$id";
$res2 = mysqli_query($conn, $sql2);

if(!$res2){
    // Failed to delete customer
    $query_success = false;
}

if($query_success){
    mysqli_commit($conn);
    // Query executed successfully and customer deleted
    // Create session variable to display message
    $_SESSION['delete'] = "<div class='success text-center'>Customer Deleted Successfully.</div>";
    // Redirect to Manage Customer Page
    header('location:'.SITEURL.'admin/manage-customer.php');
} else {
    mysqli_rollback($conn);
    // Transaction rollback
    $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Customer. Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-customer.php');
}

?>
