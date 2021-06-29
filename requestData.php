<?php
require "connect.php";
$counter=1;
// SQL query to select data from database
$sql = "SELECT * FROM hospital WHERE hospital=".$_POST['hospital'];
$result = $mysqli->query($sql);
$mysqli->close();
$latest=$result->fetch_assoc();
$response=new \stdClass();
$response->beds=$latest['latest'];
$response->addedBy=$latest['addedBy1'];
$responseJSON=json_encode($response);
echo $responseJSON;
exit();
?>