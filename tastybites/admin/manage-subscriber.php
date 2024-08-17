<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Subscribers</h1>

                <br />

                <?php  
                   // to display if email was sent to all successfully or not
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; 
                        unset($_SESSION['add']); 
                    }                   
                    // to display if subscription was removed successfully or not
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; 
                        unset($_SESSION['delete']); 
                    }   
                ?>
                <br><br><br>

                <!-- Button to Send Email -->
                <a href="send-email.php" class="btn-primary">New Email to Subscribers</a>

                <br /><br /><br />

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                  
                    <?php 
                        //Query to Get all subscribers
                        $sql = "SELECT * FROM tbl_subscriber";
                        $res = mysqli_query($conn, $sql);

                        if($res==TRUE)
                        {
                            $count = mysqli_num_rows($res); 
                            
                            $sn=1; 
                            
                            if($count>0)
                            {
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    $full_name=$rows['full_name'];
                                    $email=$rows['email'];

                                    //Display the Values in our Table
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/delete-subscriber.php?email=<?php echo $email; ?>" class="btn-danger">Remove Subscription</a>
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