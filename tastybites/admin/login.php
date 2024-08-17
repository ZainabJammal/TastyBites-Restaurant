<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Tasty Bites</title>
        <link rel="stylesheet" href="../css/admin.css">
        <style>
          body{
        	background-image:url(../images/fosyyyy.jpg) ;
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
            <h1 class="text-center">Admin Login</h1>
            <br><br>

            <?php 
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
        

            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
            <p> Username:</p>  <br>
            <input class="login_input" type="text" name="username" placeholder="Enter Username"><br><br>

            <p>Password: </p> <br>
            <input class="login_input" type="password" name="password" placeholder="Enter Password"><br><br>

            <input class="submit" type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends here -->            
        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        // Get the Data from Login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        //SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available and Login Fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }


    }

?>