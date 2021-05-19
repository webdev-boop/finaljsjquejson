<?php
    require_once('pdo.php');



    $stmt = $pdo->query('select * from Profile');

    if (!isset($_SESSION['name']))
    {
        if ( $stmt->rowCount() == 0)
        {
            echo " No rows found
<br>
<br>";
        }
        else
        {
            echo('<table class="table">
    '."\n");

    echo('
    <thead class="thead-dark">
        '."\n");

        echo('
        <tr>
            '."\n");
            echo('
            <th scope="col"> Name </th>'."\n");
            echo('
            <th scope="col"> Headline </th>'."\n");
            echo('
        </tr>'."\n");
        echo('
    </thead>'."\n");

    echo('
    <tbody>
        '."\n");
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
        {
        // print_r($row);
        echo '
        <tr scope="row">
            ';
            echo '
            <td>
                ';
                echo '<a class="" href="view.php?profile_id='.$row['profile_id'].'">'. htmlentities($row['first_name'])." ".htmlentities($row['last_name']) . '</a> ';
                echo '
            </td>';


            echo '
            <td>
                ';
                echo htmlentities( $row['headline']  );
                echo '
            </td>';
            echo '
        <tr>
            ';
            }
            echo('
    </tbody>'."\n");

    echo '
</table>';
            echo '
<br>';
        }
    }
    else
    {
        if ( $stmt->rowCount() == 0)
        {
            echo " No rows found
<br>
<br>";
        }
        else
        {
            echo('<table class="table">
    '."\n");

    echo('
    <thead class="thead-dark">
        '."\n");

        echo('
        <tr>
            '."\n");
            echo('
            <th scope="col"> Name </th>'."\n");
            echo('
            <th scope="col"> Headline	 </th>'."\n");
            echo('
            <th scope="col"> Action </th>'."\n");
            echo('
        </tr>'."\n");
        echo('
    </thead>'."\n");

    echo('
    <tbody>
        '."\n");
        while( $row = $stmt->fetch(PDO::FETCH_ASSOC) )
        {
        echo '
        <tr scope="row">
            ';

            echo '
            <td>
                ';
                echo '<a class="" href="view.php?profile_id='.$row['profile_id'].'">'. htmlentities($row['first_name'])." ".htmlentities($row['last_name']) . '</a> ';
                echo '
            </td>';

            echo '
            <td>
                ';
                echo htmlentities( $row['headline'] );
                echo '
            </td>';


            echo '
            <td>
                ';
                echo '<a class="btn btn-warning" href="edit.php?profile_id='.$row['profile_id'].'"> Edit </a> / ';

                echo '<a class="btn btn-danger" href="delete.php?profile_id='.$row['profile_id'].'"> Delete </a>  ';
                echo '
            </td>';

            echo '
        <tr>
            ';
            }
            echo('
    </tbody>'."\n");

    echo '
</table>';
            echo '
<br>';
        }

    }
