<?php 

session_start();
session_unset();
session_destroy(); 

setcookie('isLoggedIn_username', $row['username'], time() - 1000000);
setcookie('isLoggedIn_userid', $row['user_id'], time() - 1000000);
setcookie('isLoggedIn_status', true, time() - 1000000);

echo 1;

?>