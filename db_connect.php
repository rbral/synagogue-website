<!-- Page used in all pages that use database to connect the PHP to the DB -->
<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $mysqli = "shul_flow";
            
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $mysqli);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }                   
?>