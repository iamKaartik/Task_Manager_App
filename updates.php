<?php
    include('config/constants.php');

    if(isset($_GET['task_id'])){
        $task_id = $_GET['task_id'];

        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

        $db_select = mysqli_select_db($conn, DB_NAME);

        $sql = "select * from tbl_tasks where task_id = $task_id";

        $res = mysqli_query($conn, $sql);

        if($res == true){
            $row = mysqli_fetch_assoc($res);

            $task_name = $row['task_name'];
            $task_desp = $row['task_description'];
            $priority = $row['priority'];
            $list_id = $row['list_id'];
            $deadline = $row['deadline'];
        }
    }else{
        header('location:'.SITEURL);
    }

?>

<html>
    <head>
        <title>TMA</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <a class="btn-secondary" href="<?php echo SITEURL;?>">Return to HOME</a>
        <h3>Update Your Task</h3>



        <form action="" method="$_POST">
            <table class="tbl-half">
                <tr>
                    <td>Task Name</td>
                    <td><input type="text" name="task_name" value="<?php echo $task_name;?>" required></td>
                </tr>
                <tr>
                    <td>Task_description</td>
                    <td><textarea name="task_desp" id="" cols="20" rows="3"><?php echo $task_desp;?></textarea></td>
                </tr>
                <tr>
                    <td>Select List:</td>
                    <td><Select name="list_id">
                        <?php 
                            $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);
                            $db_select2 = mysqli_select_db($conn2, DB_NAME);

                            $sql2 = "select * from tbl_list";

                            $res2 = mysqli_query($conn2, $sql2);

                            if($res2 == true){
                                $sn = mysqli_num_rows($res2);

                                if($sn >0){
                                    while($row2=mysqli_fetch_assoc($res2)){
                                        $list_id_db = $row2['list_id'];
                                        $list_name = $row2['list_name'];
                                        ?>
                                        <option <?php if($list_id_db == $list_id){ echo "selected = 'selected";}  ?> value="<?php echo $list_id_db;?>"><?php echo $list_name;?></option>
                                        <?php
                                    }
                                }
                                else{
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
                        <option <?php if($priority=="High"){echo "selected='selected'";} ?>value="High">High</option>
                        <option <?php if($priority=="Medium"){echo "selected='selected'";}?>value="Medium">Medium</option>
                        <option <?php if($priority=="Low"){echo "selected='selected'";}?>value="Low">Low</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Deadline</td>
                    <td><input type="date" name="deadline" id="" value="<?php echo $deadline;?>"></td>
                </tr>
                <tr>
                    <td><input class="btn-primary btn-lg" type="submit" name="save" value="Update the Details" id=""></td>
                </tr>
            </table>
        </form>
    </div>
    </body>
</html>


<?php
if(isset($_POST['submit'])){
     $task_name= $_POST['task_name'];
     $task_desp = $_POST['task_desp'];
     $deadline = $_POST['deadline'];
    $conn3 = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
}

?>