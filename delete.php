<?php
    include('config/constants.php');

    if(isset($_GET['list_id']))
        {

            $list_id = $_GET['list_id'];
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
            $db_select = mysqli_select_db($conn, DB_NAME);

            //query for deleting
            $sql = "DELETE FROM tbl_list where list_id = $list_id";

            $res = mysqli_query($conn,$sql);

            if($res == true)
            {
                $_SESSION['delete'] = "LIST DELETED SUCCESSFULLY";
                header('location:'.SITEURL.'manage.php');
            }
            else{
                $_SESSION['delete_failed'] = "LIST DID NOT GET DELETED";
                header('location:'.SITEURL.'manage.php');
            }
        }
    else
    {
        header('location:'.SITEURL.'manage.php');
    }


?>