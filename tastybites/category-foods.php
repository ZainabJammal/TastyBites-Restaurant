<?php include('partials-front/menu.php'); ?>

    <?php 
        //Check whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set, get the id
            $category_id = $_GET['category_id'];
            // Get the Category Title from db based on Category ID
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            
            $category_title = $row['title'];
        }
        else
        {
            //Category not passed
            //Redirect to Home page
            header('location:'.SITEURL);
        }
        // customer adding a food item to cart
        if(isset($_POST['submit'])){
          if(isset($_SESSION['customer'])){
            if( !isset($_SESSION['cart'][$_POST['Foodid']]) ){
                $_SESSION['cart'][$_POST['Foodid']]['quantity'] = 1;
            }
            else{
                $_SESSION['cart'][$_POST['Foodid']]['quantity'] = $_SESSION['cart'][$_POST['Foodid']]['quantity']+1;
            }
          }
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


    <!-- Food search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2><a href="#" class="text-white">Foods on "<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->



    <!-- Food Menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                // SQL Query to Get foods based on Selected CAtegory
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                $res2 = mysqli_query($conn, $sql2);
                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    //Food is Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        
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
                              <input type="hidden" name="Offer_food_id" value="<?php echo $id ?>">
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
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
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
                    //Food not available
                    echo "<div class='error'>Food not Available.</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>