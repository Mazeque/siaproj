<?php
session_start();

include '../../connection.php';

$query = array();

$result = array();

$name = array("all", "active", "successful", "cancelled");

$query[0] = "SELECT DISTINCT order_id FROM payment GROUP BY order_id";
$query[1] = "SELECT DISTINCT order_id FROM payment WHERE order_status = 'Processing' OR order_status = 'On-delivery' GROUP BY order_id";
$query[2] = "SELECT DISTINCT order_id FROM payment WHERE order_status = 'Delivered' GROUP BY order_id";
$query[3] = "SELECT DISTINCT order_id FROM payment WHERE order_status = 'Cancelled' GROUP BY order_id";

for ($i = 0; $i < count($query); $i++) {
    $stmt = mysqli_prepare($conn, $query[$i]);
    $stmt->execute();
    $res = $stmt->get_result();

    $row = mysqli_num_rows($res);
    $result[$name[$i]] = $row;
}

echo json_encode($result);

?>