<?php 

    $username = $_GET['username'];

    $recoverypass = fetchRecovery($username);

    $response = array('available' => $recoverypass);
    header('Content-Type: application/json');
    echo json_encode($response);


    function fetchRecovery($username) {

        $servername = "localhost";
        $dbUsername = "root";
        $password = "";
        $dbname = "liriko_db";
        
        $conn = mysqli_connect($servername, $dbUsername, $password, $dbname);

        $query = "SELECT recoverypassword FROM users WHERE username = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            return $row['recoverypassword'];
        } else {
            return null;
        }

    }


?>