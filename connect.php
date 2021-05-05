<?php

// Username is root
$user = 'sql11410206';
$password = 'DDzfjguSIF';

// Database name is gfg
$database = 'sql11410206';

// Server is localhost with
// port number 3308
$servername = 'sql11.freesqldatabase.com:3306';
$mysqli = new mysqli($servername, $user,
    $password, $database);

// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
        $mysqli->connect_errno . ') ' .
        $mysqli->connect_error);
}
?>