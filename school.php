<?php
    require_once('pdo.php');
    session_start();
    if ( !isset($_SESSION['name']) ) 
    {
        die("ACCESS DENIED");
        
    }


    $stmt = $pdo->prepare('SELECT institution_id,name FROM Institution
        WHERE name LIKE :prefix');
    $stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));

    $retval = array();
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        $retval[] = $row['name'];
        // $retval[] = $row['institution_id'].'-'.$row['name'];
    }

    echo(json_encode($retval, JSON_PRETTY_PRINT));    


?>