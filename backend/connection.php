<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "lms";

    $conn = mysqli_connect($host,$user,$password,$db);

    if(!$conn){
        die("connection failed : ".mysqli_connect_error());
    }

?>