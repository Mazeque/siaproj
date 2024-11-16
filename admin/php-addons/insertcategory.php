<?php

include '../../connection.php';

$category = htmlspecialchars($_POST['category']);

$insertquery = "INSERT INTO category(category_name) VALUES (?)";

$stmt = mysqli_prepare($conn, $insertquery);

mysqli_stmt_bind_param($stmt, "s", $category);
$result = mysqli_execute($stmt);

function createPhpFile($directory, $fileName, $templateFile) {
    // Read the template file
    $templateContent = file_get_contents($templateFile);

    // Create the new file
    $file = fopen($directory . '/' . $fileName, "w");

    // Write the template content to the new file
    fwrite($file, $templateContent);

    // Close the new file
    fclose($file);
}

if ($result) {

    $directory = "../../collections";
    $fileName = strtolower($category) . ".php";
    $templateFile = "template.php";

    createPhpFile($directory, $fileName, $templateFile);

    echo true;
} else {
    echo false;
}



?>