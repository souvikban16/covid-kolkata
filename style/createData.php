<?php
    require "connect.php";
    $sql="INSERT INTO data (hospital, addedBy1, latest) VALUES(".$_POST['hospital'].",".$_POST['name'].",".$_POST['beds'].")";
    $result = $mysqli->query($sql);
    $mysqli->close();
    echo $result;
?>
