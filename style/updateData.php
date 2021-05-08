<?php
require "connect.php";
$sql = "SELECT * FROM data WHERE hospital=".$_POST['hospital'];
$result = $mysqli->query($sql);
$mysqli->close();
$response=$result->fetch_assoc();
// separating data and preparing for insert query
$last=$response['last'];
$addedBy2=$response['addedBy2'];
$latest=$response['latest'];
$addedBy1=$response['addedBy1'];
$newBeds=$_POST['beds'];
$newUser=$_POST['name'];
$insertsql = "UPDATE data SET earlier=".$last.", addedBy3='".$addedBy2."', last=".$latest.", addedBy2='".$addedBy1."', latest=".$newBeds.", addedBy1=".$newUser." WHERE hospital=".$_POST['hospital'];
echo $insertsql;
$newMysqli = new mysqli($servername, $user,
    $password, $database);

// Checking for connections
if ($newMysqli->connect_error) {
    die('Connect Error (' .
        $newMysqli->connect_errno . ') ' .
        $newMysqli->connect_error);
}
$newResult = $newMysqli->query($insertsql);
$newMysqli->close();
echo $newResult;
?>