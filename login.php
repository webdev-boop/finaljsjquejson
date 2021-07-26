<?php 

    session_start();
    require_once('pdo.php');

    // echo phpinfo();
    if ( isset($_POST['cancel'] ) ) 
    {
        
        header("Location: index.php");
        return;
    }

    $salt = 'XyZzy12*_';

    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123 // // echo "<br>";$md5 = hash('md5', 'XyZzy12*_php123');




    // Check to see if we have some POST data, if we do process it
    if ( isset($_POST['email']) && isset($_POST['pass']) ) 
    {
        if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) 
        {
            $failure = "User name and password are required";
            $_SESSION['error'] = $failure;

            header("Location: login.php");
            return;
            
        }
        elseif ( !filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) )  
        {
            $failure = "Email must have an at-sign (@)";
            $_SESSION['error'] = $failure;

            header("Location: login.php");
            return;
        } 
        else 
        {
            // $md5 = hash('md5', 'XyZzy12*_php123');

            $check = hash('md5', $salt.$_POST['pass']);

            $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  // Pw is php123

            $stmt = $pdo->prepare('SELECT user_id, name FROM users
                WHERE email = :em AND password = :pw');
            $stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            
            unset( $_SESSION['name'] );
            unset( $_SESSION['user_id'] );

            if ( $row !== false ) 
            {
                error_log("Login success ".$_POST['email']);

                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];
                // Redirect the browser to index.php
                header("Location: index.php");
                return;

            }
            elseif (!isset($_POST['pass']) && $check != $stored_hash) 
            {
                error_log("Login fail ".$_POST['email']." $check");

                $failure = "Incorrect password";
                $_SESSION['error'] = $failure;

                header("Location: login.php");
                return;
            } 
            else 
            {
                error_log("Login fail ".$_POST['email']." $check");
                
                $failure = "Incorrect password";
                $_SESSION['error'] = $failure;

                header("Location: login.php");
                return;


            }
        }
    }

// Fall through into the View
?>
<!DOCTYPE html>
    <html>
    <head>
        <title> Adelaide Guidotti </title>
        <?php require_once "bootstrap.php"; ?>
    </head>

    <body>
        <div class="container">
            <h1>Please Log In</h1>
            <?php

                if ( isset( $_SESSION['error'] ) ) 
                {

                    // Look closely at the use of single and double quotes
                    echo('<p style="color: red;">'.htmlentities( $_SESSION['error'] )."</p>\n");
                    unset( $_SESSION['error'] );
                }
            ?>
            <form method="POST">

                <label for="nam">Email</label>
                <input type="text" name="email" id="email"  class="form-control" ><br/>

                <label for="id_1723">Password</label>
                <input type="text" name="pass" id="id_1723" class="form-control" ><br/>

                <input type="submit" value="Log In" 
                 onclick="return doValidate();" class="btn btn-primary">
                <a href="index.php" class="btn btn-warning">Cancel</a>
            </form>
            <p>
                <!-- For a password hint, view source and find an account and password hint in the HTML comments. -->
                <!-- Hint:
                The account is umsi@umich.edu
                The password is the three character name of the
                programming language used in this class (all lower case)
                followed by 123. -->
            </p>
        </div>

        <script>
            function doValidate() 
            {
                console.log('Validating...');

                try 
                {
                    addr = document.getElementById('email').value;
                    pw = document.getElementById('id_1723').value;

                    console.log("Validating addr="+addr+" pw="+pw);

                    if (addr == null || addr == "" || pw == null || pw == "") 
                    {
                        alert("Both fields must be filled out");
                        return false;                        
                    }
                    if ( addr.indexOf('@') == -1 ) 
                    {
                        alert("Invalid email address");
                        return false;                        
                    } 
                    return true;

                } 
                catch (e) 
                {
                    return false;
                }
                return false;
            }

        </script>
    </body>

</html>
