<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Customer</h1>

        <br><br>

        <?php 
            // Get the ID of Selected Customer
            $id=$_GET['id'];

            // SQL Query to Get the Details of selected customer
            $sql="SELECT * FROM tbl_customer WHERE id=$id";

            $res=mysqli_query($conn, $sql);

            if($res==true)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    // Get the Details
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                    $phone=$row['phone'];
                    $email=$row['email'];
                    $address=$row['address'];
                }
                else
                {
                    //Redirect to Manage Customer PAge
                    header('location:'.SITEURL.'admin/manage-customer.php');
                }
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Phone: </td>
                    <td>
                        <input type="number" name="phone" value="<?php echo $phone; ?>">
                    </td>
                </tr>

    			<tr>
    		    	<td>Email: </td>
    		    	<td>
    		        	<input type="text" name="email" value="<?php echo $email; ?>">
    		    	</td>
    		 	</tr>

				<tr>
					<td>Address: </td>
					<td>
						<input type="text" name="address" value="<?php echo $address; ?>">
					</td>
				</tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Customer" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        //SQL Query to Update Customer
        $sql = "UPDATE tbl_customer SET
        full_name = '$full_name',
        username = '$username',
        phone = '$phone',
        email = '$email',
        address = '$address' 
        WHERE id='$id'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Customer Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-customer.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Failed to Update customer.</div>";
            //Redirect to Manage Customer Page
            header('location:'.SITEURL.'admin/manage-update.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>