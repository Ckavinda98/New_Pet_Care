<?php
include 'connect.php';

// Check if the appointment_id and status parameters are set
if (isset($_POST['appointment_id']) && isset($_POST['status'])) {
  // Get the appointment_id and status from the POST data
  $appointment_id = $_POST['appointment_id'];
  $status = $_POST['status'];

  // Call the updateStatus function to update the appointment status
  updateStatus($appointment_id, $status);
} else {
  echo "Invalid request.";
}

// Update the status of an appointment based on appointment_id
function updateStatus($appointment_id, $status) {
  global $conn;

  // Perform the update query
  $query = "UPDATE appointments SET status = '$status' WHERE appointment_id = $appointment_id";
  $result = mysqli_query($conn, $query);

  // Check if the update was successful
  if ($result) {
    echo "Appointment status updated successfully.";
  } else {
    echo "Error updating appointment status: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
