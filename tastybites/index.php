<?php
include('partials-front/menu.php'); 

// Customer adding a food item to the cart
if(isset($_POST['submit'])){
  // Check whether customer is logged in to proceed 
  if(isset($_SESSION['customer'])){
    if( !isset($_SESSION['cart'][$_POST['Foodid']]) ){
        $_SESSION['cart'][$_POST['Foodid']]['quantity'] = 1;
    }
    // Item is already in cart, increment the counter
    else{
        $_SESSION['cart'][$_POST['Foodid']]['quantity'] = $_SESSION['cart'][$_POST['Foodid']]['quantity']+1;
    }
  }
  // Customer not logged in 
  else{
    header('location:'.SITEURL.'login.php');
  }
}

// Customer adding an offer food item to the cart
if(isset($_POST['offer_submit'])){
  // Check whether customer is logged in to proceed 
  if(isset($_SESSION['customer'])){
    if( !isset($_SESSION['offer_cart'][$_POST['Offer_food_id']]) ){
        $_SESSION['offer_cart'][$_POST['Offer_food_id']]['quantity'] = 1;
    }
    // Item is already in cart, increment the counter
    else{
        $_SESSION['offer_cart'][$_POST['Offer_food_id']]['quantity'] = $_SESSION['offer_cart'][$_POST['Offer_food_id']]['quantity']+1;
    }
  }
  // Customer not logged in 
  else{
    header('location:'.SITEURL.'login.php');
  }
}
?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Foods" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

    <?php 
        // To display order details (successful or not)
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        // To display login info (if logged in successsfully)
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        
    ?>

    <!-- Offers Section Starts Here -->
    <?php 
    //SQL Query to Check if there are current offers
    $sql = "SELECT * FROM tbl_offer WHERE active='Yes'";
    $res = mysqli_query($conn, $sql);
    //Count rows to check whether the category is available or not
    $count = mysqli_num_rows($res);
    
    if($count>0){
    //Offers available
    ?>
    
    <section class="categories">
        <div class="container">
           <div class="flex">
              <img class="svg" src="images/icon/offer.svg" alt="alert" height="45px" width="45px">
              <h2 class="text-center">Limited Offers</h2>
            </div>
            <?php 
                while($row=mysqli_fetch_assoc($res))
                {
                    //Get the Values
                    $offer_id = $row['id'];
                    $title = $row['title'];
                    $new_price = $row['new_price'];
                    $to_date = $row['to_date'];
                    $food_id = $row['food_id'];
                        
                    //Getting food from database that is offered
                    $sql2 = "SELECT * FROM tbl_food WHERE id='$food_id'";
                    $res2 = mysqli_query($conn, $sql2);
                        
                    $row2=mysqli_fetch_assoc($res2);
                  
                    //Get all the values
                    $food_title = $row2['title'];
                    $old_price = $row2['price'];
                    $food_description = $row2['description'];
                    $food_image_name = $row2['image_name'];
              ?>
              <h3 class="text-center"><?php echo $title; ?></h3>
              <h3 class="text-center"><?php echo " available till ".$to_date; ?></h3>
              <div class="food-menu-box">
                  <div class="food-menu-img">
                      <?php 
                        //Check whether image available or not
                        if($food_image_name=="")
                        {
                            //Image not Available
                            echo "<div class='error'>Image not available.</div>";
                        }
                        else
                        {
                            //Image Available
                      ?>
                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $food_image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                      </div>
                      <?php } ?>
                      <div class="food-menu-desc">
                        <h4><?php echo $food_title; ?></h4>
                        <div class="flex">
                          <p class="food-price strike">$<?php echo $old_price; ?></p>
                          <p class="food-price">$<?php echo $new_price; ?></p>
                        </div>
                        <p class="food-detail">
                          <?php echo $food_description; ?>
                        </p>
                        <br>
                        
                        <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                          <input type="hidden" name="Offer_food_id" value="<?php echo $food_id ?>">
                          <input type="submit" class="btn btn-primary" name="offer_submit" value="Add to cart">
                        </form>
                      </div>
                    </div>            
            <div class="clearfix"></div>
         <?php
              } }
            ?>                                                   
    </section>   
     <!-- Offers Section Ends Here -->

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Various Food Categories</h2>

            <?php 
                //SQL Query to Display Categories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ORDER BY id LIMIT 3";
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //Categories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display Message
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white" ><mark style="background-color:white;"><?php echo $title; ?></mark></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Our Food Menu</h2>

            <?php 
            //Getting Foods from Database that are active and featured
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 4";
            $res2 = mysqli_query($conn, $sql2);
            
            $count2 = mysqli_num_rows($res2);
            //Check whether food available or not
            if($count2>0)
            {
                //Food Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    
                    $sql_offer = "SELECT * FROM tbl_offer WHERE food_id=$id AND active='Yes'";
                    $res_offer = mysqli_query($conn, $sql_offer);
                    $count_offer = mysqli_num_rows($res_offer);
                    
                    if($count_offer>0){
                      $row_offer=mysqli_fetch_assoc($res_offer);
                      $new_price = $row_offer['new_price'];
                    ?> 
                      <div class="food-menu-box">
                        <div class="food-menu-img">
                        <?php
                            //Check whether image available or not
                            if($image_name=="")
                            {
                              //Image not Available
                              echo "<div class='error text-center'>Image not available.</div>";
                            }
                            else
                            {
                              //Image Available
                          ?>
                          <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                          <?php
                            }
                          ?>
                        </div>
                      
                        <div class="food-menu-desc">
                          <h4><?php echo $title; ?></h4>
                          <div class="flex">
                            <p class="food-price strike">$<?php echo $price; ?></p>
                            <p class="food-price">$<?php echo $new_price; ?></p>
                          </div>
                          <p class="food-detail">
                            <?php echo $description; ?>
                          </p>
                          <br>
                      
                          <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                            <input type="hidden" name="Offer_food_id" value="<?php echo $food_id ?>">
                            <input type="submit" class="btn btn-primary" name="offer_submit" value="Add to cart">
                          </form>
                        </div>
                      </div>
                   <?php
                    }
                    else{    
                   ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                //Check whether image available or not
                                if($image_name=="")
                                {
                                    //Image not Available
                                    echo "<div class='error'>Image not available.</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <form action=<?php echo $_SERVER['PHP_SELF']; ?> method="post">
                                <input type="hidden" name="Foodid" value="<?php echo $id ?>">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add to cart">
                            </form>
                        </div>
                    </div>

                    <?php
                    }
                }
            }
            else
            {
                //Food Not Available 
                echo "<div class='error'>Food not available.</div>";
            }
            
            ?>
            <div class="clearfix"></div>           
        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

    
    <?php include('partials-front/footer.php'); ?>