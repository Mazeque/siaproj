<?php

include '../connection.php';

$query = "SELECT * FROM securityquestions";

$secQuestionsStmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($secQuestionsStmt);

$secQuestionResult = mysqli_stmt_get_result($secQuestionsStmt);

if ($secQuestionResult && mysqli_num_rows($secQuestionResult) > 0) {
    $rows = mysqli_fetch_all($secQuestionResult, MYSQLI_ASSOC);
    $rowCount = count($rows);
} else {
    echo 'Error';
}

for ($i = 0; $i < count($rows); $i++) {
    if ($securityquestion === $rows[$i]['questions']) {
        break;
    }
}

?>