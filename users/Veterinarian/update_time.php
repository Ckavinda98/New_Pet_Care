<?php
include 'connect.php';

// Check if the prescription_id and time parameters are set
if (isset($_POST['appointment_id']) && isset($_POST['time'])) {
  // Get the prescription_id and time from the POST data
  $appointment_id = $_POST['appointment_id'];
  $time = $_POST['time'];

  // Call the updateTime function to update the prescription time
  updateTime($appointment_id, $time);
} else {
  echo "Invalid request.";
}

// Update the time of a prescription based on prescription_id
function updateTime($appointment_id, $time) {
  global $conn;

  // Perform the update query
  $query = "UPDATE appointments SET appointment_time = '$time' WHERE appointment_id = $appointment_id";
  $result = mysqli_query($conn, $query);

  // Check if the update was successful
  if ($result) {
    echo "Appointments Time updated successfully.";
  } else {
    echo "Error updating Prescription Time: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
