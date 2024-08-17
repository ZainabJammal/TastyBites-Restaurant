<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Supplier</h1>

        <br /><br />
        <?php 
            // to display if supplier was added successfully or not
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            // to display if supplier was found or not
            if(isset($_SESSION['no-supplier-found']))
            {
                echo $_SESSION['no-supplier-found'];
                unset($_SESSION['no-supplier-found']);
            }
            
            // to display if supplier was deleted successfully or not
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            // to display if supplier was updated successfully or not
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
          
        ?>
        <br><br>

        <!-- Button to Add Supplier -->
        <a href="<?php echo SITEURL; ?>admin/add-supplier.php" class="btn-primary">Add Supplier</a>

        <br /><br /><br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Company Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Food</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>

            <?php 

                //Query to Get all suppliers from Database
                $sql = "SELECT * FROM tbl_supplier";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                //Create Serial Number Variable and assign value as 1
                $sn=1;

                if($count>0)
                {
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = isset($row['id']) ? $row['id'] : '';
                        $company = isset($row['company']) ? $row['company'] : 'N/A';
                        $phone = isset($row['phone']) ? $row['phone'] : 'N/A';
                        $email = isset($row['email']) ? $row['email'] : 'N/A';
                        $address = isset($row['address']) ? $row['address'] : 'N/A';
                        $food = isset($row['food']) ? $row['food'] : 'N/A';
                        $qty = isset($row['qty']) ? $row['qty'] : 'N/A';
                        $price = isset($row['price']) ? $row['price'] : 'N/A';

                        ?>

                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $company; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-supplier.php?id=<?php echo $id; ?>" class="btn-secondary">Update Supplier</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-supplier.php?id=<?php echo $id; ?>" class="btn-danger">Delete Supplier</a>
                                </td>
                            </tr>

                        <?php
                    }
                }
                else
                {
                    //display the error message inside table
                    ?>

                    <tr>
                        <td colspan="9"><div class="error">No Supplier Added.</div></td>
                    </tr>

                    <?php
                }                    
            ?>                                      
        </table>
    </div>    
</div>

<?php include('partials/footer.php'); ?>
