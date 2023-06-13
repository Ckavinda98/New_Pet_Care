<?php
session_start();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');

/* all the functions related to register and adding feedback */

// REGISTER USER
if (isset($_POST['register_b'])) {
  // Receive all input values from the form
  $user_id = mysqli_real_escape_string($db, $_POST['user_id']);
  $Registerid = mysqli_real_escape_string($db, $_POST['registerid']);
  $Name = mysqli_real_escape_string($db, $_POST['name']);
  $Email = mysqli_real_escape_string($db, $_POST['email']);
  $Contact_num = mysqli_real_escape_string($db, $_POST['con_num']);
  $Address = mysqli_real_escape_string($db, $_POST['address']);
  $busniess_Type = mysqli_real_escape_string($db, $_POST['user_type']);

  // Check if the username already exists
  $check_query = "SELECT * FROM busniess_details WHERE user_id='$user_id' LIMIT 1";
  $check_result = mysqli_query($db, $check_query);
  $user = mysqli_fetch_assoc($check_result);
  
  if ($user) {
    
    echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    echo '<script>window.location.href = "register.php";</script>';
    exit();
  }


 // Add the values using SQL query with POST method
$sql = "INSERT INTO busniess_details (register_id, name, busniess_type, contact_number, email, address, user_id)
VALUES ('$Registerid', '$Name', '$busniess_Type', '$Contact_num', '$Email', '$Address', '$user_id')";

$query = "UPDATE user SET user_type = '$busniess_Type' WHERE user_id = '$user_id'";

if (mysqli_query($db, $sql) && mysqli_query($db, $query)) {
$_SESSION['successMessage'] = "Registration successful.";
echo '<script>alert("Registration successful.");</script>';
echo '<script>window.location.href = "register.php";</script>';
exit();
} else {
$_SESSION['errorMessage'] = "Failed to register.";
header("Location: register.php");
exit();
}



}

?>