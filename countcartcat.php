<?php 

    include 'connection.php';

    $cat_id = $_POST['category_id'];
    
    $ccpq = "SELECT * FROM products WHERE category_id = ? AND stocks > 0";
    $ccps = mysqli_prepare($conn, $ccpq);
    $ccps->bind_param("i", $cat_id);
    $ccps->execute();

    $ccpr = $ccps->get_result();

    if ($ccpr) {
        $countcc = mysqli_num_rows($ccpr);

        echo $countcc;
    }

    exit;
?>