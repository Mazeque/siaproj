<?php



$username = $_GET['username'];

$question = fetchQuestion($username);

$response = array('available' => $question);
header('Content-Type: application/json');
echo json_encode($response);

function fetchQuestion($username) {
    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbname = "_db";
    
    $conn = mysqli_connect($servername, $dbUsername, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $checkUsername = "SELECT username,security_q,security_a FROM users WHERE username = ?";
    
    $fetchQuestionSTMT = mysqli_prepare($conn, $checkUsername);
    mysqli_stmt_bind_param($fetchQuestionSTMT, "s", $username);
    mysqli_stmt_execute($fetchQuestionSTMT);
    
    $fetchQuestionResult = mysqli_stmt_get_result($fetchQuestionSTMT);
    
    if ($fetchQuestionResult && mysqli_num_rows($fetchQuestionResult) > 0) {
        $row = mysqli_fetch_assoc($fetchQuestionResult);
        mysqli_stmt_close($fetchQuestionSTMT);
        mysqli_close($conn);

        session_start();
        $_SESSION['username'] = $username;

        return $row; 
    } else {

        mysqli_stmt_close($fetchQuestionSTMT);
        mysqli_close($conn);

        return null; 
    }
    

}
?>