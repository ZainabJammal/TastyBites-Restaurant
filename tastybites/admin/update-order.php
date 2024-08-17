<?php 
include('partials/menu.php'); 

// Check whether id is set or not
if(isset($_GET['id'])) {
    // Get the Order Details
    $id = $_GET['id'];

    $sql = "SELECT * FROM tbl_order WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if($count == 1) {
        // Order Available
        $row = mysqli_fetch_assoc($res);

        $food = $row['food'];
        $price = $row['price'];
        $qty = $row['qty'];
        $status = $row['status'];
        $customer_id = $row['customer_id'];
        $customer_address = $row['customer_address'];

        // Getting customer's details
        $sql2 = "SELECT * FROM tbl_customer where id = $customer_id";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if($count2 > 0) {
            $row2 = mysqli_fetch_assoc($res2);
            $customer_name = $row2['full_name'];
            $customer_contact = $row2['phone'];
            $customer_email = $row2['email'];
        }
    } else {
        // Order not Available
        // Redirect to Manage Order
        $_SESSION['no-order-found'] = "<div class='error'>Order Not Found.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
        exit();
    }
} else {
    // Redirect to Manage Order Page
    header('location:'.SITEURL.'admin/manage-order.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b> <?php echo $food; ?> </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b> $ <?php echo $price; ?></b>
                    </td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">                      
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
        // Check whether Update Button is Clicked or Not
        if(isset($_POST['submit'])) {
            // Get All the Values from Form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $status = $_POST['status'];
            $customer_id = $_POST['customer_id'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];

            // Update the Values
            $sql3 = "UPDATE tbl_order SET 
                qty = $qty,
                total = $total,
                status = '$status',
                customer_address = '$customer_address'
                WHERE id=$id
            ";

            $res3 = mysqli_query($conn, $sql3);

            if(!$res3) {
                // Print error if the query fails
                echo "Failed to update order: " . mysqli_error($conn);
            }

            $sql4 = "UPDATE tbl_customer SET 
            full_name = '$customer_name',
            phone = '$customer_contact',
            email = '$customer_email',
            address = '$customer_address'
            WHERE id=$customer_id
            ";

            $res4 = mysqli_query($conn, $sql4);

            if(!$res4) {
                // Print error if the query fails
                echo "Failed to update customer: " . mysqli_error($conn);
            }

            if($res3 && $res4) {
                // Updated
                $_SESSION['update'] = "<div class='success text-center'>Order Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
                exit();
            } else {
                // Failed to Update
                $_SESSION['update'] = "<div class='error text-center'>Failed to Update Order.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
                exit();
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>