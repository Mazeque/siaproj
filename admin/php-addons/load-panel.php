<?php

include '../../connection.php';

$panel = $_POST['panel'];

if ($panel === 'users') {
    $userquery = "SELECT * FROM users";

    $result = mysqli_query($conn, $userquery);

    if ($result && mysqli_num_rows($result) > 0) {
        // while ($row = mysqli_fetch_assoc($result)) {
        //     echo "<p>";
        //     echo $row['username'];
        //     echo "</p>";
        // }

        include('HTML/users.php');

    } else {
        echo "No Data";
    }
} else if ($panel === 'dashboard') {
    include('HTML/dashboard.php');
} else if ($panel === 'products') {
    include('HTML/products.php');
} else if ($panel === 'orders') {
    include('HTML/orders.php');
} else if ($panel === 'vouchers') {
    include('HTML/vouchers.php');
}
?>