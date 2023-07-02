<?php
include 'connect.php';

// Check if the prescription_id and status parameters are set
if (isset($_POST['prescription_id']) && isset($_POST['status'])) {
  // Get the prescription_id and status from the POST data
  $prescription_id = $_POST['prescription_id'];
  $status = $_POST['status'];

  // Call the updateStatus function to update the prescription status
  updateStatus($prescription_id, $status);
} else {
  echo "Invalid request.";
}

// Update the status of a prescription based on prescription_id
function updateStatus($prescription_id, $status) {
  global $conn;

  // Perform the update query
  $query = "UPDATE prescriptions SET status = '$status' WHERE prescription_id = $prescription_id";
  $result = mysqli_query($conn, $query);

  // Check if the update was successful
  if ($result) {
    echo "Prescription status updated successfully.";
  } else {
    echo "Error updating Prescription status: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);

?>
