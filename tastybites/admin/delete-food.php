<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        //Process to Delete
        //Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Remove the Image if Available
        //CHeck whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // image is available so remove from folder
            //Get the Image Path
            $path = "../images/food/".$image_name;

            //Remove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div class='error text-center'>Failed to Remove Image File.</div>";
                //Redirect to Manage Food
                header('location:'.SITEURL.'admin/manage-food.php');
                //Stop the Process of Deleting Food
                die();
            }
        }

        //Delete Food from Database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            //Food Deleted succuessfully
            $_SESSION['delete'] = "<div class='success text-center'>Food Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }       
    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error text-center'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>