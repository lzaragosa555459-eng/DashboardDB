<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "assessment_db";

$conn = mysqli_connect($host,$user,$pass,$database);


if(!$conn){
    die("Not connected".mysqli_connect_error());
}

?>
<link rel="stylesheet" href="style.css">