<?php
include '../../connection.php';

$maincategory = htmlspecialchars($_POST['maincategory']);
$subcategory = htmlspecialchars($_POST['subcategory']);

// Validate input
if (empty($maincategory) || empty($subcategory)) {
    echo 'Main category and subcategory cannot be empty.';
    exit;
}

$selectsubcategory = "SELECT * FROM category WHERE category = ?";
$selectstmt = mysqli_prepare($conn, $selectsubcategory);

if ($selectstmt) {
    mysqli_stmt_bind_param($selectstmt, "s", $maincategory);
    mysqli_stmt_execute($selectstmt);

    $selectresult = mysqli_stmt_get_result($selectstmt);

    if ($selectresult && mysqli_num_rows($selectresult) > 0) {
        $row = mysqli_fetch_assoc($selectresult);

        if ($row['subcategory'] === null) {
            $subcategories = array(
                $subcategory => 0,
            );

            $JSON_SUBCATEGORY = json_encode($subcategories);

            $updatequery = "UPDATE category SET subcategory = ? WHERE category = ?";

            $updatestmt = mysqli_prepare($conn, $updatequery);

            mysqli_stmt_bind_param($updatestmt, "ss", $JSON_SUBCATEGORY, $maincategory);

            mysqli_stmt_execute($updatestmt);

            $updateresult = mysqli_stmt_affected_rows($updatestmt);

            if ($updateresult > 0) {
                echo 'Updated Empty Value';
            } else {
                echo 'Failed to update. Please try again.';
            }
        } else {
            // Handle the case when subcategory exists
            // You can add your code here
            $subcategories = json_decode($row['subcategory'], true);

            $subcategories[$subcategory] = 0;

            $JSON_SUBCATEGORY = json_encode($subcategories);

            $updatequery = "UPDATE category SET subcategory = ? WHERE category = ?";

            $updatestmt = mysqli_prepare($conn, $updatequery);

            mysqli_stmt_bind_param($updatestmt, "ss", $JSON_SUBCATEGORY, $maincategory);

            mysqli_stmt_execute($updatestmt);

            $updateresult = mysqli_stmt_affected_rows($updatestmt);

            if ($updateresult > 0) {
                echo 'Updated / Added a Value';
            } else {
                echo 'Failed to update. Please try again.';
            }
        }
    } else {
        // Handle the case when no rows are found
        // You can add your code here
        echo 'No rows found.';
    }

    mysqli_stmt_close($selectstmt);
} else {
    // Handle the case when the prepared statement fails
    // You can add your code here
    echo 'Database error. Please try again.';
}
?>