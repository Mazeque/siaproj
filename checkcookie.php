<?php


    session_start();

    if (isset($_COOKIE['allowed'])) {
        echo true;
    } else {
        echo false;
    }



?>