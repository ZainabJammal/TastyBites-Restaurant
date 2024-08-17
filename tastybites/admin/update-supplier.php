<?php 
include('partials/menu.php'); 

// Check whether the id is set or not
if(isset($_GET['id']))
{
    // Get the ID and all other details
    $id = $_GET['id'];

    // SQL query to fetch supplier details
    $sql = "SELECT * FROM tbl_supplier WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query executed successfully
    if($res == true)
    {
        // Check if data is available
        $count = mysqli_num_rows($res);
        
        if($count == 1)
        {
            // Fetch the details
            $row = mysqli_fetch_assoc($res);

            // Check if each key exists before accessing it
            $company = isset($row['company']) ? $row['company'] : '';
            $phone = isset($row['phone']) ? $row['phone'] : '';
            $email = isset($row['email']) ? $row['email'] : '';
            $address = isset($row['address']) ? $row['address'] : '';
            $food = isset($row['food']) ? $row['food'] : '';
            $qty = isset($row['qty']) ? $row['qty'] : '';
            $price = isset($row['price']) ? $row['price'] : '';
        }
        else
        {
            // Redirect to manage supplier with error message
            $_SESSION['no-supplier-found'] = "<div class='error text-center'>Supplier not Found.</div>";
            header('location:'.SITEURL.'admin/manage-supplier.php');
            exit();
        }
    }
    else
    {
        // Redirect to manage supplier with error message
        $_SESSION['no-supplier-found'] = "<div class='error text-center'>Query failed.</div>";
        header('location:'.SITEURL.'admin/manage-supplier.php');
        exit();
    }
}
else
{
   // Redirect to Manage supplier
   header('location:'.SITEURL.'admin/manage-supplier.php');
   exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Supplier</h1>

        <br><br>

        <?php 
        // Display whether a new supplier is added successfully or not
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <br><br>

        <!-- Update Supplier Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Company Name: </td>
                    <td>
                        <input type="text" name="company" value="<?php echo htmlspecialchars($company); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="number" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>"> 
                    </td>
                </tr>

                <tr>
                    <td>Address: </td>
                    <td>
                        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Food: </td>
                    <td>
                        <input type="text" name="food" value="<?php echo htmlspecialchars($food); ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Quantity: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo htmlspecialchars($qty); ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo htmlspecialchars($price); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Supplier" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!-- Update Supplier Form Ends -->

        <?php       
        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $company = isset($_POST['company']) ? $_POST['company'] : '';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $food = isset($_POST['food']) ? $_POST['food'] : '';
            $qty = isset($_POST['qty']) ? $_POST['qty'] : '';
            $price = isset($_POST['price']) ? $_POST['price'] : '';

            // Update the Database
            $sql2 = "UPDATE tbl_supplier SET 
                company = '$company',
                phone = '$phone',
                email = '$email',
                address = '$address',
                food = '$food',
                qty = '$qty',
                price = '$price'
                WHERE id=$id
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2==true)
            {
                // Supplier Updated
                $_SESSION['update'] = "<div class='success text-center'>Supplier Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-supplier.php');
                exit();
            }
            else
            {
                // Failed to update supplier
                $_SESSION['update'] = "<div class='error text-center'>Failed to Update Supplier.</div>";
                header('location:'.SITEURL.'admin/manage-supplier.php');
                exit();
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>