<?php
include 'connect.php';

// Check if the prescription_id and time parameters are set
if (isset($_POST['prescription_id']) && isset($_POST['time'])) {
  // Get the prescription_id and time from the POST data
  $prescription_id = $_POST['prescription_id'];
  $time = $_POST['time'];

  // Call the updateTime function to update the prescription time
  updateTime($prescription_id, $time);
} else {
  echo "Invalid request.";
}

// Update the time of a prescription based on prescription_id
function updateTime($prescription_id, $time) {
  global $conn;

  // Perform the update query
  $query = "UPDATE prescriptions SET prescription_time = '$time' WHERE prescription_id = $prescription_id";
  $result = mysqli_query($conn, $query);

  // Check if the update was successful
  if ($result) {
    echo "Prescription Time updated successfully.";
  } else {
    echo "Error updating Prescription Time: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
