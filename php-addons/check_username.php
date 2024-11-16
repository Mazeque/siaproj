<?php

$username = $_GET['username'];

$isAvailable = checkUsernameAvailability($username);

$response = array('available' => $isAvailable);
header('Content-Type: application/json');
echo json_encode($response);

function checkUsernameAvailability($username) {
    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbname = "edumart_db";
    
    $conn = mysqli_connect($servername, $dbUsername, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $checkUsername = "SELECT username FROM users WHERE username = ?";
    
    $checkUserSTMT = mysqli_prepare($conn, $checkUsername);
    mysqli_stmt_bind_param($checkUserSTMT, "s", $username);
    mysqli_stmt_execute($checkUserSTMT);
    
    $checkUserResult = mysqli_stmt_get_result($checkUserSTMT);
    
    if ($checkUserResult && mysqli_num_rows($checkUserResult) > 0) {
        
        mysqli_stmt_close($checkUserSTMT);
        mysqli_close($conn);

        return false; 
    } else {

        mysqli_stmt_close($checkUserSTMT);
        mysqli_close($conn);

        return true; 
    }
    

}
?>