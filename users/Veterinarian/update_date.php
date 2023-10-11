<?php
include 'connect.php';

// Check if the prescription_id and date parameters are set
if (isset($_POST['appointment_id']) && isset($_POST['date'])) {
  // Get the prescription_id and date from the POST data
  $appointment_id = $_POST['appointment_id'];
  $date = $_POST['date'];

  // Call the updateDate function to update the prescription date
  updateDate($appointment_id, $date);
} else {
  echo "Invalid request.";
}

// Update the date of a prescription based on prescription_id
function updateDate($appointment_id, $date) {
  global $conn;

  // Perform the update query
  $query = "UPDATE appointments SET appointment_date = '$date' WHERE appointment_id = $appointment_id";
  $result = mysqli_query($conn, $query);

  // Check if the update was successful
  if ($result) {
    echo "Appointments Date updated successfully.";
  } else {
    echo "Error updating Prescription Date: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
