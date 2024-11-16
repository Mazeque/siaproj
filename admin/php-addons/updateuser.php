<?php

session_start();

include '../../connection.php';

$iduser = $_POST['id'];
$updatedusername = $_POST['username'];
$updatedfirstname = $_POST['firstname'];
$updatedmiddlename = $_POST['middlename'];
$updatedlastname = $_POST['lastname'];
$updatedemail = $_POST['email'];
$updatedcontactnumber = $_POST['contactnumber'];
$updatedgender = $_POST['gender'];
$updatedbirthday = $_POST['birthday'];
$updatedcountry = $_POST['country'];
$updatedstate = $_POST['state'];
$updatedcity = $_POST['city'];
$updatedbarangay = $_POST['barangay'];
$updatedstreet = $_POST['street'];
$updatedpostcode = $_POST['postcode'];
$updatedaccounttype = $_POST['accounttype'];


$updateuserquery = "UPDATE users SET username = ?, firstname = ?, middlename = ?, lastname = ?, email = ?, contactnumber = ?, gender = ?, 
birthday = ?, country = ?, regionstate = ?, city = ?, barangay = ?, street = ?, postcode = ?, account_type = ? WHERE id = ?";

$updateuserSTMT = mysqli_prepare($conn, $updateuserquery);
mysqli_stmt_bind_param($updateuserSTMT, "sssssssssssssssi", $updatedusername, $updatedfirstname, $updatedmiddlename, $updatedlastname, $updatedemail, $updatedcontactnumber, $updatedgender, $updatedbirthday, $updatedcountry, $updatedstate, $updatedcity, $updatedbarangay, $updatedstreet, $updatedpostcode, $updatedaccounttype, $iduser);
mysqli_stmt_execute($updateuserSTMT);

$rowsAffected = mysqli_stmt_affected_rows($updateuserSTMT);

if ($rowsAffected > 0) {
    $response = "Update Successful";

    echo $response;

} else {
    $response = 'Update failed';
    echo $response;
}

?>