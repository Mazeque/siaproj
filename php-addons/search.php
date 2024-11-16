<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "liriko_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);


$dataListQuery = "SELECT * FROM products ORDER BY name ASC";


$result = $conn->query($dataListQuery);

$data = array();

foreach($result as $row) {

    $data[] = array (
        'label' => $row['name'],
        'value' => $row['name'],
        'id' => $row['product_id']
    );
}

?>