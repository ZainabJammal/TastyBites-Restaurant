<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Customer</h1>

                <br />

                <?php 
                    // to display if customer was added successfully or not
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    // to display if customer was deleted successfully or not
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                    
                    // to display if customer was updated successfully or not
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    // to display if customer was found or not
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    
                ?>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>                     
                        <th>Actions</th>
                    </tr>

                    
                    <?php 
                        //Query to Get all customers
                        $sql = "SELECT * FROM tbl_customer";
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res); 
                            
                            $sn=1; 

                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    $phone=$rows['phone'];
                                    $email=$rows['email'];
                                    $address=$rows['address'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $phone; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-customer.php?id=<?php echo $id; ?>" class="btn-secondary">Update Customer</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-customer.php?id=<?php echo $id; ?>" class="btn-danger">Delete Customer</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                    ?>
                    
                </table>
            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php'); ?>