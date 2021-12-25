<?php
    include('config/constants.php');
    if(isset($_GET['task_id'])){
        $task_id = $_GET['task_id'];

        $conn = mysqli_connect(LOCALHOST,DB_USERNAME, DB_PASSWORD);
        $db_select = mysqli_select_db($conn, DB_NAME);

        $sql = "Delete from tbl_tasks where task_id=$task_id";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $_SESSION['deleted'] = "QUERY HAS BEEN DELETED";
            header('location:'.SITEURL);
        }
        else{
            $_SESSION['not_deleted'] = "Query has not been deleted";
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }

?>