<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Offer</h1>

        <br><br>


        <?php 
        
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                $id = $_GET['id'];
               
                $sql = "SELECT * FROM tbl_offer WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $price = $row['new_price'];
                    $to_date = $row['to_date'];
                    $active = $row['active'];
                    $current_food = $row['food_id'];
                }
                else
                {
                    //redirect to manage offer with error message
                    $_SESSION['no-offer-found'] = "<div class='error text-center'>Offer not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-offer.php');
                }

            }
            else
            {
                //redirect to Manage Offer
                header('location:'.SITEURL.'admin/manage-offer.php');
            }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Food: </td>
                    <td>
                        <select name="food">
                
                        <?php 
                            // get all food from database
                            $sql = "SELECT * FROM tbl_food";
                
                            $res = mysqli_query($conn, $sql);
                
                            $count = mysqli_num_rows($res);
                
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $food_id = $row['id'];
                                    $food_title = $row['title'];
                
                        ?>
                        <option <?php if($current_food==$food_id){echo "selected";} ?> value="<?php echo $food_id; ?>"><?php echo $food_title; ?></option>
                
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
                        <input type="number" step="any" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Available Until: </td>
                    <td>
                        <input type="date" name="to_date" value="<?php echo $to_date; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 

                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Offer" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //Get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $price = $_POST['price'];
                $to_date = $_POST['to_date'];
                $food_id = $_POST['food'];
                $active = $_POST['active'];

                //Update the Database
                $sql2 = "UPDATE tbl_offer SET 
                    title = '$title',
                    food_id = '$food_id',
                    new_price = '$price',
                    to_date = '$to_date',
                    active = '$active' 
                    WHERE id=$id
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    //Offer Updated
                    $_SESSION['update'] = "<div class='success text-center'>Offer Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-offer.php');
                }
                else
                {
                    //failed to update offer
                    $_SESSION['update'] = "<div class='error text-center'>Failed to Update Offer.</div>";
                    header('location:'.SITEURL.'admin/manage-offer.php');
                }
            }        
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>