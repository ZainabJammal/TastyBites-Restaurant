<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Offer</h1>

        <br><br>

        <?php 
           // to display whether a new offer is added successfully or not
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
              
        ?>

        <br><br>

        <!-- Add Offer Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Offer Title">
                    </td>
                </tr>

                <tr>
                    <td>Food: </td>
                    <td>
                         <select name="food" required>
                
                         <?php 
                             // get all food from database
                             $sql = "SELECT * FROM tbl_food";
                
                             $res = mysqli_query($conn, $sql);
                
                             $count = mysqli_num_rows($res);
                
                             if($count>0)
                             {
                                 while($row=mysqli_fetch_assoc($res))
                                 {
                                     $id = $row['id'];
                                     $foodtitle = $row['title'];
                
                         ?>
                
                         <option value="<?php echo $id; ?>"><?php echo $foodtitle; ?></option>
                
                         <?php
                             }
                           }
                          else
                          {
                         ?>
                         <option value="0">No Food Found</option>
                         <?php
                           }
                         ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" step="any" name="price" required>
                    </td>
                </tr>
                
                <tr>
                    <td>Available Until: </td>
                    <td>
                        <input type="date" name="to_date">
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Offer" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <!-- Add Category Form Ends -->

        <?php       
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];
                $food = $_POST['food'];
                $price = $_POST['price'];
                $to_date = $_POST['to_date'];

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }                

                //SQL Query to Insert Offer into Database
                $sql = "INSERT INTO tbl_offer SET 
                    title='$title',
                    new_price='$price',
                    to_date='$to_date',
                    food_id='$food',
                    active='$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //Query Executed and Category Added
                    $_SESSION['add'] = "<div class='success text-center'>Offer Added Successfully.</div>";
                    //Redirect to Manage Offer Page
                    header('location:'.SITEURL.'admin/manage-offer.php');
                }
                else
                {
                    //Failed to Add Offer
                    $_SESSION['add'] = "<div class='error text-center'>Failed to Add Offer.</div>";
                    //Redirect to Manage Offer Page
                    header('location:'.SITEURL.'admin/add-offer.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>