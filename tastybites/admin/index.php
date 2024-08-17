<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Administrator Dashboard</h1>
                <br><br>
                <?php 
                    //to display if log in was successful
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

                <div class="col-4 text-center" style="background-color:#ececec;" >

                    <?php 
                        //Sql Query to count categories
                        $sql = "SELECT * FROM tbl_category";
                        
                        $res = mysqli_query($conn, $sql);
                        
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br />
                   <br> Food Categories
                </div>

                <div class="col-4 text-center" >

                    <?php 
                        //Sql Query to count food
                        $sql2 = "SELECT * FROM tbl_food";
                       
                        $res2 = mysqli_query($conn, $sql2);
                        
                        $count2 = mysqli_num_rows($res2);
                    ?>

                    <h1><?php echo $count2; ?></h1>
                    <br />                   
                   <br>  Foods
                </div>                
                
                <div class="col-4 text-center" style="background-color:#ececec;">
                
                    <?php 
                        //Sql Query to count offers
                        $sql12 = "SELECT * FROM tbl_offer";
                
                        $res12 = mysqli_query($conn, $sql12);
                
                        $count12 = mysqli_num_rows($res12);
                    ?>
                
                    <h1><?php echo $count12; ?></h1>
                    <br />                    
                   <br>  Offers
                </div>

                <div class="col-4 text-center" >
                    
                    <?php 
                        //Sql Query to count orders
                        $sql3 = "SELECT * FROM tbl_order";
                       
                        $res3 = mysqli_query($conn, $sql3);
                        
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />                   
                  <br>   Total Orders
                </div>

                <div class="col-4 text-center" style="background-color:#ececec;">
                    
                    <?php 
                        // SQL Query to Get Total Revenue Generated
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        $res4 = mysqli_query($conn, $sql4);

                        $row4 = mysqli_fetch_assoc($res4);
                        
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br />                   
                   <br>  Revenue Generated
                </div>

                <div class="col-4 text-center" >
                    
                    <?php 
                        //Sql Query to count pending orders
                        $sql6 = "SELECT * FROM tbl_order WHERE status = 'Ordered'";
                       
                        $res6 = mysqli_query($conn, $sql6);
                        
                        $count6 = mysqli_num_rows($res6);
                    ?>

                    <h1><?php echo $count6; ?></h1>
                    <br />
                   <br>  Pending Orders
                </div>

                <div class="col-4 text-center" style="background-color:#ececec;">
                    
                    <?php 
                        //Sql Query to count delivery orders
                        $sql7 = "SELECT * FROM tbl_order WHERE status = 'On Delivery'";
                       
                        $res7 = mysqli_query($conn, $sql7);
                        
                        $count7 = mysqli_num_rows($res7);
                    ?>

                    <h1><?php echo $count7; ?></h1>
                    <br />
                  <br>   On Delivery Orders
                </div>


                <div class="col-4 text-center" >                    
                    <?php 
                        //Sql Query to count cancelled orders
                        $sql8 = "SELECT * FROM tbl_order WHERE status = 'Cancelled'";
                        
                        $res8 = mysqli_query($conn, $sql8);
                       
                        $count8 = mysqli_num_rows($res8);
                    ?>

                    <h1><?php echo $count8; ?></h1>
                    <br />
                   <br>  Cancelled Orders
                </div>
                
                <div class="col-4 text-center" style="background-color:#ececec;">
                
                    <?php 
                        //Sql Query to count registered customers
                        $sql9 = "SELECT * FROM tbl_customer";
                       
                        $res9 = mysqli_query($conn, $sql9);
                        
                        $count9 = mysqli_num_rows($res9);
                    ?>
                
                    <h1><?php echo $count9; ?></h1>
                    <br />                    
                  <br>   Registered Customers
                </div>

                <div class="col-4 text-center" >
                
                    <?php 
                        //Sql Query to count subscribers
                        $sql10 = "SELECT * FROM tbl_subscriber";
                
                        $res10 = mysqli_query($conn, $sql10);
                
                        $count10 = mysqli_num_rows($res10);
                    ?>
                
                    <h1><?php echo $count10; ?></h1>
                    <br />
                   <br>  Subscribers
                </div>
                
                <div class="col-4 text-center" style="background-color:#ececec;">
                
                    <?php 
                        //Sql Query to count supplier
                        $sql13 = "SELECT * FROM tbl_supplier";
                
                        $res13 = mysqli_query($conn, $sql13);
                
                        $count13 = mysqli_num_rows($res13);
                    ?>
                
                    <h1><?php echo $count13; ?></h1>
                    <br />                   
                    <br>  Food Suppliers
                </div>

                <div class="col-4 text-center" >
                    
                    <?php 
                        //Sql Query to count admins
                        $sql11 = "SELECT * FROM tbl_admin";
                        
                        $res11 = mysqli_query($conn, $sql11);
                        
                        $count11 = mysqli_num_rows($res11);
                    ?>

                    <h1><?php echo $count11; ?></h1>
                    <br />                   
                   <br>  System Administrator
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>