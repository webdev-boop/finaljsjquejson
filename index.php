<?php
    require_once('pdo.php');
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Adelaide Guidotti</title>

<?php require_once "bootstrap.php"; ?>

</head>
    <body>

        <div class="container">
            <h1 style="text-align:center; margin-bottom: 50px" >Adelle's Resume Registry </h1>
            <?php
                ////flash messages
                if (isset($_SESSION['error'] ) ) 
                {
                    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'] ) ) 
                {
                    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                    unset($_SESSION['success']);

                }
                        
            ?>

            <?php 
                if (!isset($_SESSION['name'])) 
                {                 
            ?>    
                    <p>
                        <a href="login.php">Please log in</a>
                    </p>

                    <?php require_once('all_data_view.php'); ?>

                    <!-- <p>
                        Attempt to go to 
                        <a href="add.php">add data</a> without logging in - it should fail with an error message.
                    </p> -->

            <?php
               }
               else
               {
                    require_once('all_data_view.php');
            ?>        
                    <a href="add.php" class="btn btn-success">Add New Entry</a> 
                    <br>
                    <br>

                    <a href="logout.php" class="btn btn-success">logout</a>       
            <?php 
               }
            ?>          



        </div>   

</body>

</html>     
