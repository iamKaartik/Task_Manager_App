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
        <h1>TASK MANAGER</h1>

        <a class="btn-secondary"href="<?php echo SITEURL;?>">HOME</a>
        <h3>Add Task Page</h3>
        <p>
            <?php

            if(isset($_SESSION['add_fail'])){
                echo $_SESSION['add_fail'];
                unset($_SESSION['add_fail']);
            }
            ?>
        </p>
        <form action="" method="POST">
            <table class="tbl-half">
                <tr>
                    <td>Task Name</td>
                    <td><input type="text" name="task_name" placeholder="Type your task name" required></td>
                </tr>
                <tr>
                    <td>Task Description</td>
                    <td><textarea name="task_desp" id="" cols="20" rows="3" placeholder="Write task description"></textarea></td>
                </tr>
                <tr>
                    <td>Select List</td>
                    <td><select name="list_id">
                        <?php
                            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                            $db_select = mysqli_select_db($conn, DB_NAME);

                            $sql = "select * from tbl_list";


                            $res = mysqli_query($conn, $sql);

                            if($res == true)
                            {
                                $cr = mysqli_num_rows($res);

                                if($cr > 0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $list_id = $row['list_id'];
                                        $list_name = $row['list_name'];
                                        ?>

                                        <option value="1"><?php echo $list_name;?></option>

                                        <?php
                                    }
                                }else
                                {
                                    ?>

                                    <option value="0">None</option>
                                    
                                    <?php
                                }
                            }


                        ?>
                        
                        
                    </Select></td>
                </tr>
                <tr>
                    <td>Priority</td>
                    <td><select name="priority" id="">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Deadline</td>
                    <td><input type="date" name="deadline"/></td>
                </tr>
                <tr>
                    <td><input class ="btn-primary btn-lg"type="submit" value="Save the Details" name="submit"></td>
                </tr>
            </table>
        </form>
    </div>


    </body>
</html>


<?php
if(isset($_POST['submit'])){
    //echo 'button submitted';

    $task_name = $_POST['task_name'];
    $task_desp = $_POST['task_desp'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];


    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD);
    $db_select2 = mysqli_select_db($conn2, DB_NAME);

    $sql2 = "insert into tbl_tasks set
    task_name = '$task_name',
    task_description = '$task_desp',
    list_id = $list_id,
    priority = '$priority',
    deadline = '$deadline'
    ";

    $res2 = mysqli_query($conn2, $sql2);

    if($res2 == true)
    {
        $_SESSION['add'] = "TASK HAS BEEN ADDED";
        header('location:'.SITEURL);
    }else{
        $_SESSION['add_fail'] = "Fail to add task";
        header('location:'.SITEURL.'adds.php');
    }

}

?>