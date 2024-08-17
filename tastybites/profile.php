<?php
  include('partials-front/menu.php');
 
  $customerId = $_SESSION['customer'];
  
  //Fetching customer's information
  $sql1="SELECT * FROM tbl_customer WHERE id=$customerId";
  $res1=mysqli_query($conn, $sql1);
  
  if($res1==true)
  {
    $count1 = mysqli_num_rows($res1);
    if($count1==1)
    {
      $row1=mysqli_fetch_assoc($res1);
      $name = $row1['full_name'];
      $username = $row1['username'];
      $pwd = $row1['password'];
      $phone=$row1['phone'];
      $email=$row1['email'];
      $address=$row1['address'];
    }
  }
  
 //if customer requests to cancel his most recent order
 if(isset($_GET['order_date'])){
   $date = $_GET['order_date'];
   $sql2 = "UPDATE tbl_order SET status = 'Cancelled' WHERE order_date='$date' AND customer_Id=$customerId";
   
   $res2 = mysqli_query($conn, $sql2);
   if($res2==true)
   {
     $_SESSION['update'] = "<div class='success text-center'>Order Deleted Successfully.</div>";
     unset($_SESSION['order_date']);
   }
   else
   {
     $_SESSION['update'] = "<div class='error text-center'>Failed to Delete Order.</div>";
   }
 }

 //if customer requests to remove his subscription
 if(isset($_GET['subscription'])){
   $sql3 = "DELETE FROM tbl_subscriber WHERE email='$email'";
   $res3 = mysqli_query($conn, $sql3);
   if($res3==true)
   {
     $_SESSION['update'] = "<div class='success'>Subscription Removed Successfully. Refill the review form to subscribe again.</div>";
   }
   else
   {
     $_SESSION['update'] = "<div class='error'>Failed to remove subscription.</div>";
   }
 }



 // if customer requests to update his information
 if(isset($_POST['save']))
 {
   $name = $_POST['name'];
   $username = $_POST['username'];
   $phone =$_POST['phone'];
   $email = $_POST['email'];
   $address =$_POST['address'];
   
   $oldPwd =$_POST['oldPwd'];
   $newPwd =$_POST['newPwd'];
   
   // Checking if customer wants to change password
   if($oldPwd != "" && $newPwd != ""){
     // checking if old password (in database) matches password input by customer
     if($oldPwd != $pwd){
       $_SESSION['update'] = "<div class='error'>Your old password is incorrent</div>";
       header('location:'.SITEURL.'profile.php');
     }
     // updating customer's info + passwords
     $sql6 = "UPDATE tbl_customer SET
     full_name = '$name',
     username = '$username',
     password = '$newPwd',
     phone = '$phone',
     email = '$email',
     address = '$address' 
     WHERE id='$customerId'
     ";
   }
   else{ 
     // updating customer's info  
     $sql6 = "UPDATE tbl_customer SET
     full_name = '$name',
     username = '$username',
     phone = '$phone',
     email = '$email',
     address = '$address' 
     WHERE id='$customerId'
     ";
   }
   $res6 = mysqli_query($conn, $sql6);
   if($res6==true)
   {
     $_SESSION['update'] = "<div class='success'>Your Profile Updated Successfully.</div>";
     header('location:'.SITEURL.'profile.php');
   }
   else
   {
     $_SESSION['update'] = "<div class='error'>Failed to Update Your Profile.</div>";
     header('location:'.SITEURL.'profile.php');
   }
 }
   
?>

<html>
    <head>
        <title>Profile - Tasty Bites</title>
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/profile.css">
    </head>

    <body>          
      <?php
      // Displaying if changes are successful
      if(isset($_SESSION['update']))
      {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
      }
      ?>
      <!-- Customer's Info Section  -->
      <section class="flex">
         <section class="sec1">
           <img src="images/icon/user.svg" width="140px" height="150px">
           <h1 class="title">Welcome</h1>
           <h1 class="title"><?php echo $name; ?></h1>
           
           <?php
             $sql7="SELECT * FROM tbl_subscriber WHERE email='$email'"; 
             $res7=mysqli_query($conn, $sql7);
             if($res7==true)
             {
               $count7 = mysqli_num_rows($res7);
               if($count7==1)
               {
                 echo "<a href='profile.php?subscription=no' class='buttons'>Remove Subscription</a>"; 
               }
             }
           ?>
           <br><br><br>
           <a href="logout.php" class="buttons">Logout</a><br><br><br>
          
         </section>
         <section class="sec2">
         <div>
           <h1>About</h1>
           <form method="post" action="profile.php">
             <label>Name:</label><input type="text" name="name" value="<?php echo $name; ?>" required><br>              
             <label>Username:</label><input type="text" name="username" value="<?php echo $username; ?>" required><br>              
             <label>Old Password:</label><input type="text" name="oldPwd"><br>              
             <label>New Password:</label><input type="text" name="newPwd"><br>                           
             <label>Phone:</label><input type="tel" name="phone" value="<?php echo $phone; ?>" required><br>
             <label>Email:</label><input type="email" name="email" value="<?php echo $email; ?>" required><br>             
             <label>Address:</label><textarea name="address" rows="2" class="input-responsive" required><?php echo $address; ?></textarea>             
             <input type="submit" name="save" class="submit" value="Save" class="btn btn-primary button" >             
           </form>
         </div>
         
         <!-- Recent Order Section -->         
         <div>
           <h1>Recent Order</h1>
           <div class="order">
           <?php
             // checking if customer has ordered in this session
             if(isset($_SESSION['order_date'])){
               $order_date = $_SESSION['order_date'];
               $sql8="SELECT * FROM tbl_order WHERE order_date='$order_date' AND customer_id='$customerId'";
               $res8=mysqli_query($conn, $sql8);            
                              
               if($res8==true)
               {
                 $count8 = mysqli_num_rows($res8);
                 if($count8>0)
                 {
                    echo "
                    <table class='tbl-full'>
                    <tr>
                    <th>Food</th>
                    <th>Quantity</th>
                    </tr>
                    ";
                    // Fetching items ordered
                    while($row8=mysqli_fetch_assoc($res8)){
                      $food = $row8['food'];
                      $qty = $row8['qty'];
                      echo "
                      <tr>
                        <td>".$food."</td>
                        <td>".$qty."</td>
                      </tr>
                      ";
                    }
                    echo "<a href='profile.php?order_date=".$order_date."' class='button submit'>Cancel Order</a>";
                 }
               }
             }
             // no recent order in this session
             else{
               echo "You have no recent order!";
             }
             ?>                       
           </div>
         </div>
         </section>
      </section>          
    </body>
</html>