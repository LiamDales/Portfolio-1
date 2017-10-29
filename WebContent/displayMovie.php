<html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
<body>

<?php

    function getContactById($n) {

        $servername = 'lochnagar.abertay.ac.uk' ;
        $database = 'sql1702439' ;
        $username = 'sql1702439' ;
        $password = 'n8HXtGlbgGVg' ;

        //  connect to the database to get current state
        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
        $sql = "select * from movies where id = ".$n  ;
        $result1 = mysqli_query($conn, $sql);
        //var_dump($result1) ;
        $r = mysqli_fetch_assoc($result1) ;
        // var_dump($r) ;
        $contacttext = '{"id" : '.$r['id'].',' ;
        $contacttext = $contacttext . '"name" : "'.$r['name'].'" ,' ;
        $contacttext = $contacttext . '"url" : "'.$r['url'].'" ,' ;
        $contacttext = $contacttext . '"bio" : "'.$r['bio'].'" ,' ;
        $contacttext = $contacttext . '"rating" : "'.$r['rating'].'" ,' ;
        $contacttext = substr($contacttext, 0, -2) ;
        $contacttext = $contacttext.'}' ;
        return $contacttext ;
    }

    ?>
            <h3>Display Movie</h3>
            <p>
                <?php echo' <a href="display.php?id='.$id.'" ';?> class="btn btn-danger">Back</a>
            </p>
            <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                            <th>Movie Name</th>
                            <th></th>
                            <th>Bio</th>
                            <th>Rating</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $id = $_GET['id'] ;
                      $contacttxt = getContactById($id) ;
                      $contactjson = json_decode($contacttxt) ;
                            echo '<tr>';
                            echo '<td>'.$contactjson -> name.'</td>';
                            echo '<td><img width="300" height="400" src="'.$contactjson -> url.'"></td>';
                            echo '<td>'.$contactjson -> bio.'</td>';
                            echo '<td>'.$contactjson -> rating.'</td>';
                            echo ' ';
                            echo '</td>';
                            echo '</tr>';

                       Database::disconnect();
                      ?>
                     </tbody>
             </table>
</body>
</html>