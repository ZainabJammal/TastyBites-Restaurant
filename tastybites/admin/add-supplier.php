<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Supplier</h1>

        <br><br>

        <?php 
           // to display whether a new supplier is added successfully or not
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
           
        ?>

        <br><br>

        <!-- Add Supplier Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Company Name: </td>
                    <td>
                        <input type="text" name="company" placeholder="Company Name">
                    </td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="number" name="phone" placeholder="Phone">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" placeholder="Email"> 
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <input type="text" name="address" placeholder="address">
                    </td>
                </tr>
                
                <tr>
                    <td>Food: </td>
                    <td>
                        <input type="text" name="food" placeholder="Food supplying">
                    </td>
                </tr>
                
                <tr>
                    <td>Quantity: </td>
                    <td>
                        <input type="number" name="qty" placeholder="Quantity">
                    </td>
                </tr>
                
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" placeholder="Price">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Supplier" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Category Form Ends -->

        <?php       
            if(isset($_POST['submit']))
            {
                $company = $_POST['company'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $food = $_POST['food'];
                $qty = $_POST['qty'];
                $price = $_POST['price'];
              
                //SQL Query to Insert Category into Database
                $sql = "INSERT INTO tbl_supplier SET 
                    company_name='$company',
                    phone='$phone',
                    email='$email',
                    address='$address',
                    food='$food',
                    qty='$qty',
                    price='$price'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Query Executed and Supplier Added
                    $_SESSION['add'] = "<div class='success text-center'>Supplier Added Successfully.</div>";
                    //Redirect to Manage supplier Page
                    header('location:'.SITEURL.'admin/manage-supplier.php');
                }
                else
                {
                    //Failed to Add supplier
                    $_SESSION['add'] = "<div class='error text-center'>Failed to Add Supplier.</div>";
                    //Redirect to Manage Supplier Page
                    header('location:'.SITEURL.'admin/add-supplier.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>