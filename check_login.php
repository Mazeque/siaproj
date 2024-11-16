<?php
  session_start();

  if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
    $response = array(
        'isLoggedIn' => true,
        'user_id' => $_SESSION['userid']
    );
  } else {
    $response = array('isLoggedIn' => false);
  }

  // Send the response as JSON
  header('Content-Type: application/json');
  echo json_encode($response);
?>