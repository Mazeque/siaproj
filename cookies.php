<?php
$accept = true;
setcookie('allowed', $accept, time() + 604800);

session_start();

if (isset($_COOKIE['allowed'])) {
    echo 'True';
} else {
    echo isset($_COOKIE['allowed']) ? $_COOKIE['allowed'] : 'False';
}

exit;
?>
