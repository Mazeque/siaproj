<?php

session_start();

include '../../connection.php';

$session_id = $_POST['id'];
$session_username = $_POST['usernameses'];
$session_firstname = $_POST['firstnameses'];
$session_middlename = $_POST['middlenameses'];
$session_lastname = $_POST['lastnameses'];
$session_accounttype = $_POST['accounttypeses'];

$isUpdated = null;

if ($session_id == $_SESSION['admin']['id']) {
    if ($_SESSION['admin']['username'] !== $session_username || $_SESSION['admin']['firstname'] !== $session_firstname ||
        $_SESSION['admin']['middlename'] !== $session_middlename || $_SESSION['admin']['lastname'] !== $session_lastname) {
        if ($session_accounttype === 'Admin') {
            $_SESSION['admin']['username'] = $session_username;
            $_SESSION['admin']['firstname'] = $session_firstname;
            $_SESSION['admin']['middlename'] = $session_middlename;
            $_SESSION['admin']['lastname'] = $session_lastname;
        
            $isUpdated = true;
        } else {

            $isUpdated= false;

        }

    } 
} else {
    $isUpdated = true;
}

echo $isUpdated;

?>