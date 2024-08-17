<?php include('partials-front/menu.php'); ?>

    <?php 
        //Check whether customer is logged in or not
        if(isset($_SESSION['customer'])){
          $customerid = $_SESSION['customer'];
          $sql1 = "SELECT * FROM tbl_customer WHERE id=$customerid";
          
          $res1 = mysqli_query($conn, $sql1);
          $count = mysqli_num_rows($res1);
          
          if($count==1){
            //Fetching the Data 
            $row1 = mysqli_fetch_assoc($res1);
            $customername = $row1['full_name'];
            $customeraddress = $row1['address'];
            $customerphone = $row1['phone'];
          }
        }
        // customer not logged in
        else{
          header('location:'.SITEURL.'login.php');
        }
        
        //Check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //Get the Food id of the selected food
            $food_id = $_GET['food_id'];

            //Get the Details of the Selected Food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            $res = mysqli_query($conn, $sql);
            
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //Fetching the data
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                
            }
            else
            {
                //Food not Availabe
                //Redirect to Home Page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- Cart Section Starts Here: Displaying Items in cart -->
    <section class="food-search2">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //Check whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>
                </fieldset>
                
                <!-- Displaying Customer's Info -->
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" value="<?php echo $customername; ?>" class="input-responsive" disabled>
                    
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" value="<?php echo $customerphone; ?>" class="input-responsive" disabled>
                    
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" class="input-responsive" required><?php echo $customeraddress; ?></textarea>
                    
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                //Check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    $order_date = date("Y-m-d h:i:s"); //Order DAte

                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_id = $_SESSION['customer'];
                    $customer_address = $_POST['address'];

                    //Sql to save the Order in Databaase
                    $sql2 = "INSERT INTO `tbl_order`(`food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_address`, `customer_id`) VALUES ('".$food."','".$price."','".$qty."','".$total."','".$order_date."','".$status."','".$customer_address."', '".$customer_id."')";
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true)
                    {
                        //Query Executed and Order Saved
                        $_SESSION['order_date']=$order_date;
                        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //Failed to Save Order
                        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                        header('location:'.SITEURL);
                    }
                }
            ?>
        </div>
    </section>
    <!-- Cart Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>