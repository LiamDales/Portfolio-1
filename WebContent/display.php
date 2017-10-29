<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<h1>Display All Movies Using JSON</h1>
	<?php
    function getAllContacts() {
        //  include the login credentials
        $servername = 'lochnagar.abertay.ac.uk' ;
        $database = 'sql1702439' ;
        $username = 'sql1702439' ;
        $password = 'n8HXtGlbgGVg' ;

        //  connect to the database to get current state
        $conn = mysqli_connect($servername, $username, $password, $database);
        if (!$conn) { die("Connection failed: " . mysqli_connect_error()); }
        $sql = "SELECT * FROM movies" ;
        $result = mysqli_query($conn, $sql);

        //  convert to JSON
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    ?>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Movie ID</th>
            <th>Movie Name</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $contacttxt = getAllContacts() ;
        $contactjson = json_decode($contacttxt) ;

        //  now write out the details
        $cl = $contactjson ;
        for ($i=0 ; $i<sizeof($cl) ; $i++) {
            echo '<tr>';
            echo '<td>'.$cl[$i] -> id . '</td>';
            echo '<td>'.$cl[$i] -> name . '</td>';
            echo '<td>'.'<a class="btn btn-success" href="displayMovie.php?id='.$cl[$i] -> id.'">Click Here For more Info</a></td>';
            echo '</td>';
            echo '</tr>';
        }

        Database::disconnect();
        ?>
        </tbody>
    </table>
</body>
</html>