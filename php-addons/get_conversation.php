<?php
$id = $_GET['chat-id'];

$conversation = fetchConversation($id);

$response = array('conversation' => $conversation);
header('Content-Type: application/json');
echo json_encode($response);

function fetchConversation($id) {
    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbname = "db";
    
    $conn = mysqli_connect($servername, $dbUsername, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $checkConversation = "SELECT conversation FROM chats WHERE id = ?";
    
    $fetchConversationSTMT = mysqli_prepare($conn, $checkConversation);
    mysqli_stmt_bind_param($fetchConversationSTMT, "s", $id);
    mysqli_stmt_execute($fetchConversationSTMT);
    
    $fetchConversationResult = mysqli_stmt_get_result($fetchConversationSTMT);
    
    if ($fetchConversationResult && mysqli_num_rows($fetchConversationResult) > 0) {
        $row = mysqli_fetch_assoc($fetchConversationResult);
        
        mysqli_stmt_close($fetchConversationSTMT);
        mysqli_close($conn);

        return $row['conversation']; 
    } else {
        mysqli_stmt_close($fetchConversationSTMT);
        mysqli_close($conn);

        return null; 
    }
}
?>