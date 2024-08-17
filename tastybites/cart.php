<?php 
  include('partials-front/menu.php');  

  // Check whether user is logged in to fetch his information
  if(isset($_SESSION['customer'])){
    $customerid = $_SESSION['customer'];
    $sql1 = "SELECT * FROM tbl_customer WHERE id=$customerid";
    $res1 = mysqli_query($conn, $sql1);
    $count = mysqli_num_rows($res1);
    if($count==1){
      $row1 = mysqli_fetch_assoc($res1);
      $customername = $row1['full_name'];
      $customeraddress = $row1['address'];
      $customerphone = $row1['phone'];
    }
  }
  else{
    header('location:'.SITEURL.'login.php');
  }
  
  //Check whether submit button is clicked to add items in cart to order
  if(isset($_POST['submit']))
  {
    // Get all the details from the form
    foreach($_SESSION['cart'] as $productid => $detail){
      $sql = "SELECT * FROM tbl_food WHERE id=$productid";
      //Execute the Query
      $res = mysqli_query($conn, $sql);
  
  	  $food=$_SESSION['cart'][$productid]['title'];
      $price=$_SESSION['cart'][$productid]['price'];
	  $qty=$_SESSION['cart'][$productid]['quantity'];
  
	  $total = $price * $qty; // total = price x qty 
  
	  $order_date = date("Y-m-d h:i:s"); //Order Date
  
	  $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
	  $customer_id = $_SESSION['customer'];
	  $customer_address = $_POST['address'];
  
  
	  //Save the Order in Databaase
	  $sql2 = "INSERT INTO `tbl_order`(`food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_id`, `customer_address`) VALUES ('".$food."','".$price."','".$qty."','".$total."','".$order_date."','".$status."','".$customer_id."','".$customer_address."')";
	  $res2 = mysqli_query($conn, $sql2);
  
	  //Check whether query executed successfully or not
	  if($res2==false)
	  { 
		  $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
		  header('location:'.SITEURL);
	  }
    }
    
    foreach($_SESSION['offer_cart'] as $productid => $detail){
      $food=$_SESSION['offer_cart'][$productid]['title'];
      $price=$_SESSION['offer_cart'][$productid]['price'];
      $qty=$_SESSION['offer_cart'][$productid]['quantity'];
    
      $total = $price * $qty; // total = price x qty 
    
      $order_date = date("Y-m-d h:i:s"); //Order Date
    
      $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
      $customer_id = $_SESSION['customer'];
      $customer_address = $_POST['address'];
        
      //Save the Order in Databaase
      $sql2 = "INSERT INTO `tbl_order`(`food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_id`, `customer_address`) VALUES ('".$food."','".$price."','".$qty."','".$total."','".$order_date."','".$status."','".$customer_id."','".$customer_address."')";
      $res2 = mysqli_query($conn, $sql2);
    
      //Check whether query executed successfully or not
      if($res2==false)
      { 
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
        header('location:'.SITEURL);
      }
    }
    
    unset($_SESSION['cart']); 
    unset($_SESSION['offer_cart']);
    $_SESSION['order_date']=$order_date;
    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
    header('location:'.SITEURL);
  }


  
  // if customer cancelled all items in cart
  else{
    if(isset($_POST['cancel'])){
      unset($_SESSION['cart']);    
      unset($_SESSION['offer_cart']);
      header('location:'.SITEURL.'cart.php');
    }
  }
?>
    
    <!-- Cart Section: Displaying Items in Cart -->
    <section class="food-search2">
        <div class="container">
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form action="<?php echo SITEURL.'cart.php'; ?>" method="post" class="order">  
                <?php 
                   // Fetching items in session "offer_cart"
                  if(isset($_SESSION['offer_cart'])){
                    foreach($_SESSION['offer_cart'] as $productid => $detail){
                      $sql = "SELECT * FROM tbl_food WHERE id=$productid";
                      $res = mysqli_query($conn, $sql);
                      $count = mysqli_num_rows($res);
                      if($count==1){
                        $row = mysqli_fetch_assoc($res);
                        $_SESSION['offer_cart'][$productid]['title'] = $row['title'];
                        $image_name = $row['image_name'];
                        
                        $sql2 = "SELECT * FROM tbl_offer WHERE food_id=$productid AND active='Yes'";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                        if($count2==1){
                          $row2 = mysqli_fetch_assoc($res2);
                          $_SESSION['offer_cart'][$productid]['price'] = $row2['new_price'];                                        
                        }
                      }
                ?>
                
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
                  <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                  <?php  } ?>              
                </div>
                
                <div class="food-menu-desc">
                  <h3><?php echo $_SESSION['offer_cart'][$productid]['title']; ?></h3>
                  <input type="hidden" name="food" value="<?php echo $_SESSION['offer_cart'][$productid]['title']; ?>">
                
                  <p class="food-price">$<?php echo $_SESSION['offer_cart'][$productid]['price']; ?></p>
                  <input type="hidden" name="price" value="<?php echo $_SESSION['offer_cart'][$productid]['price']; ?>">
                
                  <div class="order-label">Quantity</div>
                  <input type="number" name="qty" class="input-responsive" value="<?php echo $_SESSION['offer_cart'][$productid]['quantity']; ?>" required>                  
                </div>
                </fieldset>
                <?php  } } ?>
                
                <?php 
                    // Fetching items in session "cart"
                    if(isset($_SESSION['cart'])){
                        foreach($_SESSION['cart'] as $productid => $detail){
                            $sql = "SELECT * FROM tbl_food WHERE id=$productid";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count==1){
                                $row = mysqli_fetch_assoc($res);
                                $_SESSION['cart'][$productid]['title'] = $row['title'];
                                $_SESSION['cart'][$productid]['price'] = $row['price'];
                                $image_name = $row['image_name'];
                            }
                ?>
         
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
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawain Pizza" class="img-responsive img-curve">
                            <?php  } ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $_SESSION['cart'][$productid]['title']; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $_SESSION['cart'][$productid]['title']; ?>">

                        <p class="food-price">$<?php echo $_SESSION['cart'][$productid]['price']; ?></p>
                        <input type="hidden" name="price" value="<?php echo $_SESSION['cart'][$productid]['price']; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="<?php echo $_SESSION['cart'][$productid]['quantity']; ?>" required>
                        
                    </div>

                </fieldset>
                <?php  } } ?>
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
            <div class="empty">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" name="cancel" value="Empty Cart" class="btn btn-primary">
                </form>
            </div>           
        </div>
    </section>
    <!-- Cart Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>