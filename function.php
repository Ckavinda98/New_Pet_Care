<?php
session_start();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');

/* all the functions related to register and adding feedback */

// REGISTER USER
if (isset($_POST['register'])) {
  // Receive all input values from the form
  $Uname = mysqli_real_escape_string($db, $_POST['username']);
  $Password = mysqli_real_escape_string($db, $_POST['password']);
  $Email = mysqli_real_escape_string($db, $_POST['email']);
  $User_Type = mysqli_real_escape_string($db, $_POST['user_type']);


  // Check if the username already exists
  $check_query = "SELECT * FROM user WHERE username='$Uname' LIMIT 1";
  $check_result = mysqli_query($db, $check_query);
  $user = mysqli_fetch_assoc($check_result);
  
  if ($user) {
    
    echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    echo '<script>window.location.href = "register.php";</script>';
    exit();
  }

  // Add the values using SQL query with POST method
  $sql = "INSERT INTO user (username, password, email, user_type)
          VALUES ('$Uname', '$Password', '$Email', '$User_Type')";

if (mysqli_query($db, $sql)) {
 
  echo '<script>alert("Registration successful.");</script>';
  echo '<script>window.location.href = "login.php";</script>';
  exit();
} else {
  
  echo '<script>alert("Failed to register.");</script>';
  echo '<script>window.location.href = "register.php";</script>';
  
  exit();
}
}
?>