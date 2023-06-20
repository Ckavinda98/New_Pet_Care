<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the appointment ID and new status from the AJAX request
  $appointmentId = $_POST["appointment_id"];
  $newStatus = $_POST["status"];

  // Update the appointment status in the database
  $query = "UPDATE appointments SET status = '$newStatus' WHERE appointment_id = '$appointmentId'";
  $result = mysqli_query($conn, $query);
  if ($result) {
    // Update successful
    http_response_code(200);
  } else {
    // Update failed
    http_response_code(500);
  }
} else {
  // Invalid request method
  http_response_code(400);
}

?>
