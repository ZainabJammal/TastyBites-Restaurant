<?php
 include('partials-front/menu.php');
 
 $name='';
 $email='';
 // fetch customer's info if logged in
 if(isset($_SESSION['customer'])){
   $customerid = $_SESSION['customer'];
   $sql = "SELECT * FROM tbl_customer WHERE id=$customerid";
   $res = mysqli_query($conn, $sql);
   $count = mysqli_num_rows($res);
   if($count==1){
     $row = mysqli_fetch_assoc($res);
     $name = $row['full_name'];
     $email = $row['email'];
   }
 }
 
 //if customer submitted the review form 
 if(isset($_POST['submit'])) {
   $name_submit = $_POST['name'];
   $email_submit = $_POST['email'];

   $to = 'tastybites202@gmail.com';   
      
   // Set the email subject 
   $subject = $name_submit. "'s Review";
   
   // Build the email message
   $referrer = $_POST['referrer']; 
   $rating = $_POST['rating']; 
   $comments = $_POST['comments']; 
    //if user checked subscription box
   if(isset($_POST['subscribe'])){
       $subscribe="Yes";
       //check email has not already subscribed    
       $sql = "SELECT FROM tbl_subscriber WHERE email='$email_submit'";
       $res = mysqli_query($conn, $sql);
       if($res==false)
       {
         $sql2="INSERT INTO tbl_subscriber SET full_name = '$name_submit', email = '$email_submit'";
         $res2 = mysqli_query($conn, $sql2);
       }
   }
   else{
     $subscribe="No";
   }

   $message = "Name: " . $name_submit . "\n\n";
   $message .= "Email: " . $email_submit . "\n\n";
   $message .= "How did you hear about us? " . $referrer . "\n\n";
   $message .= "Would you visit again? " . $rating . "\n\n";
   $message .= "Comments: " . $comments;
   $message .= "Sign me up for email updates? " . $subscribe . "\n\n";  
   
   // Send the email
   mail($to, $subject, $message);
   $_SESSION['message'] = "<div class='success text-center'>Thank you for your submission!</div>";
   header('location:'.SITEURL.'contact.php');
 }
?>

<html>
  <head>  
    <title>Contact Us</title>
    <style>
      .submit, select{
        padding:7px;
        border-radius:7px;
        margin:20px;
        border:1px solid #5d9e5f;
      }
      input{
        margin:10px;
        padding:7px;
        border-radius:9px;
      }
      legend{
        color:#5d9e5f;
        font-weight:bold;
      }
      p{
        margin:15px;
      }
      label{
        color: #2f3542;
      }
      select{
        background-color:#ececec;;
      }
    </style>
  </head> 
  <body>
	<section class="food-search">
  		<h1 style="color:white;"><center>Welcome To Tasty Bites</center></h1>  
	</section>
	
	<?php 
	  // to display whether review message is sent successfully or not
  	  if(isset($_SESSION['message']))
	  {
	    echo $_SESSION['message'];
	    unset($_SESSION['message']);
	   }
	?>
	
	<!-- Review Form Section starts here -->
	<form action="" method="post" class="text-center">   
		<fieldset>    
			<legend>Your Details:</legend>    
			<label>     
				Name:<input type="text" value="<?php if($name) {echo $name;} ?>" name="name" size="50" maxlength="100" width="50"  height="30">    
			</label>    
			<br />   <br> 
			<label>     
		   	    Email:<input type="email" value="<?php if($email) {echo $email;} ?>" name="email" size="50" maxlength="100" width="50" height="30">    
			</label>    
			<br />   
		</fieldset>   

		<fieldset>    
			<legend>Your Review:</legend>    
			<p>     
				<label for="hear-about">      
					How did you hear about us?     
				</label>     
				<select name="referrer" id="hear-about">      
					<option value="google">Google</option>      
					<option value="friend">Friend</option>      
					<option value="advert">Advert</option>      
					<option value="other">Other</option>
				</select>
			</p>
			<p>
 				Would you visit again?     
				<br />     
				<label>      
					<input type="radio" name="rating" value="yes" />      
					Yes     
				</label>     
				<label>      
					<input type="radio" name="rating" value="no" />      
					No     
				</label>     
				<label>      
					<input type="radio" name="rating" value="maybe" />      
					Maybe     
				</label>    
			</p>    
			<p>     
				<label for="comments">      
					Comments:     
				</label>     
				<br />     
				<textarea rows="4" cols="40" id="comments" name="comments">     
				</textarea>   
		 	</p>    
			<label>     
				<input type="checkbox" name="subscribe" checked="checked" />      
				Sign me up for email updates    
			</label>    
			<br />    
			<input class="btn-primary submit" type="submit" name="submit" value="Submit review" />   
		</fieldset>  
	</form> 
	<!-- Review Form Section ends here  -->
</body> 
</html> 