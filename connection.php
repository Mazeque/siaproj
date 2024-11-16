<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edumart_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>