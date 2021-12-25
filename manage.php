<?php
    include('config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task_Manager</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
    <h1>TASK MANAGER</h1>
    <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
    <h3>Manage List Page</h3>

    <p>
        <?php
        if(isset($_SESSION['Add']))
        {
            echo $_SESSION['Add'];
            unset($_SESSION['Add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['delete_failed']))
        {
            echo $_SESSION['delete_failed'];
            unset($_SESSION['delete_failed']);
        }

        ?>
    </p>
    <div class="list">
        <a class="btn-primary"href="<?php echo SITEURL; ?>add.php">Add List</a>
        <table class="tbl-full">
            <tr>
                <th>Serial_Number</th>
                <th>List_Name</th>
                <th>Actions</th>
            </tr>

            <?php
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
            $db_select = mysqli_select_db($conn, DB_NAME);

            $sql = "SELECT * FROM tbl_list";

            $res = mysqli_query($conn, $sql);

            if($res == true)
            {
                //echo " Executed";

                $count_rows = mysqli_num_rows($res);
                $sn = 1;

                if($count_rows > 0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        //fetching the data
                        $list_id = $row['list_id'];
                        $list_name = $row['list_name'];
                        ?>

                        <tr>
                            <td><?php echo $sn++;?>.         </td>
                            <td><?php echo $list_name; ?> </td>
                            <td>
                                <a href="update.php?list_id=<?php echo $list_id;?>">Update</a>
                                <a href="<?php echo SITEURL;?>delete.php?list_id=<?php echo $list_id;?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="3">No List Added Yet</td>
                    </tr>
                    <?php
                }
            }
            ?>
            
        </table>
    </div>
</div>
</body>
</html>