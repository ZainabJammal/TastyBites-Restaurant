<?php
 include('partials-front/menu.php');
?>
<html>
    <head>
        <title>Login - Tasty Bites</title>
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
            <h1 class="text-center">Customer Login</h1>
            <br><br>

            <?php 
                // Display login if successful
                if(isset($_SESSION['customer_login']))
                {
                    echo $_SESSION['customer_login'];
                    unset($_SESSION['customer_login']);
                }             
            ?>
        
            <!-- Login Form Starts Here -->
            <form action="login.php" method="POST" class="text-center">
            <p>Username:</p> <br>
            <input class="login_input" type="text" name="username" placeholder="Enter Username"><br><br>

            <p>Password:</p> <br>
            <input class="login_input" type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="submit">
            <br><br>
            </form>
            <!-- Login Form Ends Here -->
            
            <a href="signUp.php" class="signUp">Don't have account? Sign up here!</a>            
        </div>        
    </body>
</html>

<?php
 //Check whether the Submit Button is Clicked or NOt
 if(isset($_POST['submit']))
 {
   //Process for Login
   //1. Get the Data from Login form
   $username = $_POST['username'];
   $password =$_POST['password'];
 
   //2. SQL to check whether the customer with username and password exists or not
   $sql = "SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'";
 
   //3. Execute the Query
   $res = mysqli_query($conn, $sql);
 
   //4. Count rows to check whether the customer exists or not
   $count = mysqli_num_rows($res);
 
   if($count==1)
   {
     //Customer Available and Login Successful
     $_SESSION['customer_login'] = "<div class='success'>Login Successful.</div>";
     $row1 = mysqli_fetch_assoc($res);
     $customerID = $row1['id'];
 
     $_SESSION['customer'] = $customerID; //TO check whether the customer is logged in
     $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
     //Redirect to home page
     header('location:'.SITEURL.'index.php');
   }
   else
   {
	 //Customer not logged in
	 $_SESSION['customer_login'] = "<div class='error text-center'>Username or Password did not match.</div>";
	 //Redirect to Login Page
	 header('location:'.SITEURL.'login.php');
   } 
 } 
?>