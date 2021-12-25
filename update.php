<?php
    include('config/constants.php');

    if(isset($_GET['list_id']))
    {
        $list_id = $_GET['list_id'];

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
        $db_select = mysqli_select_db($conn, DB_NAME);

        $sql = "SELECT * FROM tbl_list where list_id = $list_id";

        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            $row = mysqli_fetch_assoc($res);
            
            //print_r($row);

            $list_name = $row['list_name'];
            $list_desciption = $row['list_desciption'];
        }else{
            header('location:'.SITEURL.'manage.php');
        }


    }
?>

<HTML>
    <head>
        <title>TMA</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <div class="menu">
            <a class="btn-secondary" href="<?php echo SITEURL;?>">Return to HOME</a>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>manage.php">Return to MANAGE LIST</a>
        </div>

        <h3>Update List Page</h3>

        <p>
            <?php

            if(isset($_SESSION['Update_fail'])){
                echo $_SESSION['Update_fail'];
                unset($_SESSION['Update_fail']);
            }
            ?>
        </p>
        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>List Name</td>
                    <td><input type="text" name ="list_name" value="<?php echo $list_name; ?>" required ="required"></td>
                </tr>
                <tr>
                    <td>List Description</td>
                    <td><textarea name="list_description" id="" cols="21" rows="3" > 
                        <?php echo $list_desciption; ?>
                    </textarea></td>
                </tr>
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="submit" value = "Update"></td>
                </tr>
            </table>
        </form>
    </div>
    </body>
</HTML>





<?php

if(isset($_POST['submit'])){
    //echo 'button clicked'

    $list_name = $_POST['list_name'];
    $list_desp = $_POST['list_description'];

    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
    $db_select2 = mysqli_select_db($conn2, DB_NAME);

    $sql2 = "UPDATE tbl_list set
    list_name = '$list_name',
    list_desciption = '$list_desp'
    where list_id = $list_id
    ";

    $res2 = mysqli_query($conn2, $sql2);

    if($res2 == true)
    {
        $_SESSION['update'] = "LIST GOT UPDATED";

        header('location:'.SITEURL.'manage.php');
    }else{
        $_SESSION['Update_fail'] = "LIST HAS NOT GOT UPDATED";
        header('location:'.SITEURL.'update.php?ist_id='.$list_id);
    }
}

?>







