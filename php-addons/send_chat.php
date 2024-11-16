<?php
session_start();

include '../connection.php';

$data = json_decode(file_get_contents("php://input"));

if ($data === null) {
    echo json_encode(['error' => 'Failed to decode JSON data.']);
    exit();
}

$sender = mysqli_real_escape_string($conn, $data->sender);
$message = mysqli_real_escape_string($conn, $data->message);
$date = mysqli_real_escape_string($conn, $data->date);
$id = mysqli_real_escape_string($conn, $data->id);

$selectquery = "SELECT conversation FROM chats WHERE id = ?";
$selectstmt = mysqli_prepare($conn, $selectquery);

if ($selectstmt === false) {
    echo json_encode(['error' => 'Failed to prepare select statement: ' . mysqli_error($conn)]);
    exit();
}

mysqli_stmt_bind_param($selectstmt, "s", $id);

if (mysqli_stmt_execute($selectstmt)) {
    mysqli_stmt_store_result($selectstmt); 

    mysqli_stmt_bind_result($selectstmt, $conversation);
    mysqli_stmt_fetch($selectstmt);


    $existingMessages = json_decode($conversation, true);

    if ($existingMessages === null) {

        $existingMessages = array();
    }

    $count = count($existingMessages);

    $newKey = $count + 1;

    $newMessage = array(
        "sender" => $sender,
        "message" => $message,
        "date" => $date
    );
    
    $existingMessages[$newKey] = $newMessage;

    $newConversation = json_encode($existingMessages);

    $updatequery = "UPDATE chats SET conversation = ? WHERE id = ?";
    $updatestmt = mysqli_prepare($conn, $updatequery);

    if ($updatestmt === false) {
        echo json_encode(['error' => 'Failed to prepare update statement: ' . mysqli_error($conn)]);
        exit();
    }

    mysqli_stmt_bind_param($updatestmt, "ss", $newConversation, $id);

    if (mysqli_stmt_execute($updatestmt)) {

        header('Content-Type: application/json');

        if (json_encode($existingMessages)) {
            echo json_encode($existingMessages);
        } else {
            echo json_encode(['error' => 'Failed to encode JSON.']);
        }
    } else {
        echo json_encode(['error' => 'Failed to execute update statement: ' . mysqli_error($conn)]);
    }

    mysqli_stmt_close($updatestmt);
} else {
    echo json_encode(['error' => 'Failed to execute select statement: ' . mysqli_error($conn)]);
}

mysqli_stmt_close($selectstmt);

mysqli_close($conn);
?>
