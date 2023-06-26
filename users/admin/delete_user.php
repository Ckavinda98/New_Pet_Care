<?php
include 'connect.php';

  // Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');
if (!$db) {
    die('Connect Error: ' . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve user ID from form submission
  $userId = $_POST["user_id"];

  // Perform the delete query using the retrieved user ID
  $sql = "DELETE FROM user WHERE user_id='$userId'";

  // Execute the query
  if (mysqli_query($db, $sql)) {
    echo '<script>alert("User deleted successfully.");</script>';
    echo '<script>window.location.href = "usertable.php";</script>';
  } else {
    echo '<script>alert("Error deleting user: ' . mysqli_error($db) . '");</script>';
  //   echo '<script>window.location.href = "usertable.php";</script>';
  }
}

// Close the database connection
mysqli_close($conn);
?>
