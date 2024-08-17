<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Offers</h1>

        <br /><br />
        <?php 
            // to display if offer was added successfully or not
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            // to display if offer was deleted successfully or not
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            // to display if offer was found or not
            if(isset($_SESSION['no-offer-found']))
            {
                echo $_SESSION['no-offer-found'];
                unset($_SESSION['no-offer-found']);
            }

            // to display if offer was updated successfully or not
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
                        
        ?>
        <br><br>

                <!-- Button to Add Offer -->
                <a href="<?php echo SITEURL; ?>admin/add-offer.php" class="btn-primary">Add Offer</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th width="5%">S.N.</th>
                        <th width="10%">Title</th>
                        <th width="10%">Food</th>
                        <th width="5%">New Price</th>
                        <th width="10%">Available Until</th>
                        <th width="7%">Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 

                        //Query to Get all Offers from Database
                        $sql = "SELECT * FROM tbl_offer ORDER BY id DESC "; // Display the Latest Offer at First

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        //Create Serial Number Variable and assign value as 1
                        $sn=1;

                        if($count>0)
                        {
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $new_price = $row['new_price'];
                                $to_date = $row['to_date'];
                                $active = $row['active'];
                                $food_id = $row['food_id'];
                                
                                // get details of food
                                $sql2 = "SELECT * FROM tbl_food WHERE id=$food_id";                                
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                if($count2>0)
                                {
                                    $row2=mysqli_fetch_assoc($res2);
                                    $food_title = $row2['title'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $food_title; ?>. </td>
                                        <td><?php echo $new_price; ?></td>
                                        <td><?php echo $to_date; ?>. </td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-offer.php?id=<?php echo $id; ?>" class="btn-secondary">Update Offer</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-offer.php?id=<?php echo $id; ?>" class="btn-danger">Delete Offer</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                          }
                        }
                        else
                        {
                            //display the error message inside table
                            ?>

                            <tr>
                                <td colspan="6"><div class="error text-center">No Offer Available.</div></td>
                            </tr>

                            <?php
                          }                    
                       ?>
                                      
          </table>
    </div>    
</div>

<?php include('partials/footer.php'); ?>