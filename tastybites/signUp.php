<?php 
  include('partials-front/menu.php');
?>

<html>
    <head>
        <title>Sign Up - Tasty Bites</title>
        <link rel="stylesheet" href="css/admin.css">
        <style>
          body{
            background-image:url(images/fosyyyy.jpg) ;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            align-items: center;
          }
          body::before{
            content: "";
            position: fixed;
            background-attachment: scroll;
            min-width: 100vw;
            min-height: 100vh;
            top: 0;
            bottom: 0;
            background-color: black;
            opacity: .6;
            z-index: -1;
          }
          .login h1{
            color:#5d9e5f;
          }           
          p{
            color:white;
          }      
        </style>
    </head>

    <body>        
        <div class="login">
            <h1 class="text-center">Customer Sign up</h1>
            <br><br>

            <?php 
              // Display if signUp successful or not
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
        

            <!-- Sign up Form Starts Here -->
            <form action="signUp.php" method="POST" class="text-center">
            <p> Fullname:</p> <br>
            <input class="login_input" type="text" name="fullname" placeholder="Enter Fullname"><br><br>

            <p>Contact Number:</p> <br>
            <input class="login_input" type="number" name="contact" placeholder="Enter Contact Number"><br><br>

            <p>Email: </p><br>
            <input class="login_input" type="text" name="email" placeholder="Enter Email"><br><br>

            <p>Address:</p> <br>
            <input class="login_input" type="text" name="address" placeholder="Enter Address"><br><br>

            <p>Username:</p><br>
            <input class="login_input" type="text" name="username" placeholder="Enter Username"><br><br>

            <p>Password:</p> <br>
            <input class="login_input" type="password" name="password" placeholder="Enter Password"><br><br>

            <input class="submit" type="submit" name="submit" value="Sign up" class="btn-primary">
            <br><br>
            </form>
            <!-- Sign up Form Ends HEre -->            
        </div>
    </body>
</html>

<?php 

    //Check whether the Submit Button is clicked or not
    if(isset($_POST['submit']))
    {
        // Get the Data from form
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        // SQL to check whether a user with chosen username exists or not
        $sql = "SELECT * FROM tbl_customer WHERE username='$username'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //Username already exists
            $_SESSION['login'] = "<div class='success'>Username already exists</div>";
            //Redirect to sign up page
            header('location:'.SITEURL.'signUp.php');
        }
        else
        {
            $sql="INSERT INTO `tbl_customer`(`full_name`, `username`, `password`, `phone`, `email`, `address`) VALUES ('".$fullname."','".$username."','".$password."','".$contact."','".$email."','".$address."')";
            $res = mysqli_query($conn, $sql);
  
           //CHeck whether data inserted or not
           // Redirect with message to home page
           if($res == true)
           {
             //Data inserted Successfullly
             $id = mysqli_insert_id($conn);
             $_SESSION['customer'] = $id; //TO check whether the customer is logged in
             $_SESSION['login'] = "<div class='success text-center'>Sign Up Successful.</div>";
             header('location:'.SITEURL.'index.php');
           }
           else
           {
             //Failed to Insert Data
             $_SESSION['add'] = "<div class='error text-center'>Failed to Sign Up</div>";
             header('location:'.SITEURL.'signUp.php');
           }  
      }
  }
?>