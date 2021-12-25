<?php
    include('config/constants.php');
?>

<html>
    <head>
        <title>TMA</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="wrapper">
        <h1><b>TASK MANAGER</b></h1>

        <!--    Menu    -->
        <div class="menu">
            <a href="<?php echo SITEURL; ?>">Home</a>
            <a href="#">To do</a>
            <a href="#">Doing</a>
            <a href="#">Done</a>



            <a href="<?php echo SITEURL; ?>Manage.php">Manage_List</a>
        </div>


        <p>
            <?php

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }


            if(isset($_SESSION['deleted'])){
                echo $_SESSION['deleted'];
                unset($_SESSION['deleted']);
            }

            if(isset($_SESSION['not_deleted'])){
                echo $_SESSION['not_deleted'];
                unset($_SESSION['not_deleted']);
            }
            ?>

           
        </p>
        <!--    Task   -->
        
        <div class="task">
            <a class="btn-primary" href="<?php echo SITEURL; ?>adds.php">Add Task</a>
            <table class="tbl-full">
                <tr>
                    <th>Serial_Number</th>
                    <th>Task_Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
                <?php
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD);
                    $db_select = mysqli_select_db($conn, DB_NAME);

                    $sql = "select * from tbl_tasks";

                    $res = mysqli_query($conn, $sql);

                    if($res == true)
                    {
                        $cr = mysqli_num_rows($res);
                        $aa = 1;

                        if($cr > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                                $deadline = $row['deadline'];
                                ?>
                                <tr>
                                    <td><?php echo $aa++;?></td>
                                    <td><?php echo $task_name;?></td>
                                    <td><?php echo $priority;?></td>
                                    <td><?php echo $deadline;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>updates.php?task_id=<?php echo $task_id;?>">Update</a>
                                        <a href="<?php echo SITEURL;?>deletes.php?task_id=<?php echo $task_id;?>">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="5">No task Added here</td>
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