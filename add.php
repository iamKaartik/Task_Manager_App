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

        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>

        <a class="btn-secondary" href="<?php echo SITEURL; ?>manage.php">Manage List</a>


        <h3>Add List Page</h3>

        <p>
            <?php
            //check if session is created or not
            if(isset($_SESSION['Add_fail'])){
                echo $_SESSION['Add_fail'];
                unset($_SESSION['Add_fail']);
            }
            ?>
        </p>
        <!---->
        <form class="" action="" method="POST">

            <table>
                <tr>
                    <td>list name</td>
                    <td><input type="text" name="List_name" placeholder="Type List Name Here" required></td>
                </tr>
                <tr>
                    <td>List Description</td>
                    <td><input type="text" name="List_description" id="" placeholder="Type the Description"></td>
                </tr>
                <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="Submit"></td>
                </tr>
            </table>

        </form>
    </div>

    </body>
</html>


<?php

    if(isset($_POST['submit']))
    {
        //echo "Form Submitted";
        $list_name = $_POST['List_name'];
        $list_desp = $_POST['List_description'];

        //connect db
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

        $db_select = mysqli_select_db($conn, DB_NAME);      

        //sql query 
        $sql = "INSERT INTO tbl_list SET 
        list_name = '$list_name',
        list_desciption = '$list_desp'
        ";

        //execute query
        $res = mysqli_query($conn, $sql);

        if($res == true)
        {
            //create a session variable to display the message
            $_SESSION['Add'] = "LIST ADDED SUCCESSFULLY";

            //echo "Data submitted";
            header('location:'.SITEURL.'manage.php');
           
            
        }else{

            $_SESSION['Add_fail'] = "FAILED TO ADD LIST";
            header('location:'.SITEURL.'add.php');
        }
    }

?>