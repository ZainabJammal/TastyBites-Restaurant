<?php 
    //Include constants.php 
    include('config/constants.php');
    //1. Destory the Session
    session_destroy(); 
    //2. Redirect to home Page
    header('location:'.SITEURL.'index.php');

?>