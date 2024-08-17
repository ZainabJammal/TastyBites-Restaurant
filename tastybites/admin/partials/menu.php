<?php 
include('../config/constants.php'); 
include('login-check.php');
?>
<html>
    <head>
        <title>Tasty Bites</title>

        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="logo">
                <a href="index.html" title="Logo">
                    <img src="../images/logores.png" alt="Restaurant Logo" class="img-responsive" height="65px" width="65px">
                </a>
            </div>

            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="manage-category.php">Categories</a></li>
                    <li><a href="manage-food.php">Food Items</a></li>
                    <li><a href="manage-offer.php">Offers</a></li>
                    <li><a href="manage-order.php">Orders</a></li>
                    <li><a href="manage-customer.php">Customer's Section</a></li>
                    <li><a href="manage-subscriber.php">Subscriber's Section</a></li>
                    <li><a href="manage-supplier.php">Supplier's Section</a></li>
                    <li><a href="manage-admin.php">Admin's Section</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->
         