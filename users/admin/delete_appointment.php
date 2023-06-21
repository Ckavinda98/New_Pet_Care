<?php
include 'connect.php';

// Check if the appointment_id parameter is set
if (isset($_POST['appointment_id'])) {
  // Get the appointment_id from the POST data
  $appointment_id = $_POST['appointment_id'];

  // Call the deleteAppointment function to delete the appointment
  deleteAppointment($appointment_id);
} else {
  echo "Invalid request.";
}

// Delete appointment based on appointment_id
function deleteAppointment($appointment_id) {
  global $conn;

  // Perform the deletion query
  $query = "DELETE FROM appointments WHERE appointment_id = $appointment_id";
  $result = mysqli_query($conn, $query);

  // Check if the deletion was successful
  if ($result) {
    echo "Appointment deleted successfully.";
  } else {
    echo "Error deleting appointment: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
