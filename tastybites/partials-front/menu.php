<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- website is responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasty Bites</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logores.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>contact.php">Contact</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>cart.php">Cart</a>
                    </li>
                    <li>
                      <?php
                        if(!isset($_SESSION['customer'])){
                          echo "<a href='".SITEURL."login.php'>Login</a>";
                        }
                        else{
                          echo "<a href='".SITEURL."profile.php'>My Profile</a>";
                        }
                      ?>             
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->