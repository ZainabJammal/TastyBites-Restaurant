<?php
include('partials/menu.php'); 

// Check if send button is clicked
if(isset($_POST['submit'])) {
    $subject = htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8');
    
    // Check if the database connection is established
    if($conn) {
        $sql = "SELECT * FROM tbl_subscriber";
        $res = mysqli_query($conn, $sql);   
        
        if($res) {
            $count = mysqli_num_rows($res);    
            
            if($count > 0) {
                while($rows = mysqli_fetch_assoc($res)) {
                    $email = $rows['email'];
                    // Send the email
                    mail($email, $subject, nl2br($content));                 
                }
                
                $_SESSION['add'] = "<div class='success text-center'>Email sent to all subscribers</div>";
            } else {
                $_SESSION['add'] = "<div class='error text-center'>No Subscribers.</div>";
            }
            
        } else {
            $_SESSION['add'] = "<div class='error text-center'>Failed to retrieve subscribers.</div>";
        }
        
    } else {
        $_SESSION['add'] = "<div class='error text-center'>Database connection failed.</div>";
    }

    // Redirect to manage subscribers page
    header('location:'.SITEURL.'admin/manage-subscriber.php');
}
?>

<html>
<head>  
    <title>Email For Subscribers</title>
    <style>
        .submit {
            padding: 7px;
            border-radius: 7px;
            margin: 20px;
            border: 1px solid #5d9e5f;
        }
        input, textarea {
            margin: 10px;
            padding: 7px;
            border-radius: 9px;
            width: calc(100% - 24px);
        }
        p {
            margin: 15px;
        }
        label {
            color: #2f3542;
        }
    </style>
</head> 
<body>
    <!-- Email Form Section starts here -->
    <form action="" method="post" class="text-center">   
        <fieldset>        
            <p>     
                <label for="subject">      
                    Subject:     
                </label>     
                <br />     
                <textarea rows="3" cols="50" id="subject" name="subject"></textarea>   
            </p>   
            <br />   <br> 
        </fieldset>   

        <fieldset>    			    
            <p>     
                <label for="content">      
                    Content:     
                </label>     
                <br />     
                <textarea rows="4" cols="100" id="content" name="content"></textarea>   
            </p>    
            <br />    
            <input class="btn-primary submit" type="submit" value="Send Email" name="submit" />   
        </fieldset>  
    </form> 
    <!-- Email Form Section ends here  -->
</body> 
</html>
