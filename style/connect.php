<?php

// Username is root

// main server creds
$user = 'sql11410206';
$password = 'DDzfjguSIF';

//local test creds
// $user = 'root';
// $password = '';

// main server database name
$database = 'sql11410206';

// local test database 
// $database = 'hospital_data';

// Server is localhost with

// main servername with port
$servername = 'sql11.freesqldatabase.com:3306';

// local test servername
// $servername = 'localhost';

$mysqli = new mysqli($servername, $user,
    $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}
?>