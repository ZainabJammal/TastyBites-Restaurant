<?php 

    //Include constants.php file here
    include('../config/constants.php');

    //get the ID of supplier to be deleted
    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_supplier WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    
    if($res==true)
    {
        //Supplier Deleted succuessfully
        $_SESSION['delete'] = "<div class='success text-center'>Supplier Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-supplier.php');
    }
    else
    {
        //Failed to Delete Supplier
        $_SESSION['delete'] = "<div class='error text-center'>Failed to Delete Supplier.</div>";
        header('location:'.SITEURL.'admin/manage-supplier.php');
    }       

?>