<?php
session_start();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pet_care_db');
if (!$db) {
    die('Connect Error: ' . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the user ID from the form
    $userId = (int)$_POST["user_id"];
  
    // Retrieve the updated fields from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
  
    // Perform the update query
    $query = "UPDATE user SET username='$username', email='$email', password='$password' WHERE user_id='$userId'";
  
    // Execute the query
    if (mysqli_query($db, $query)) {
        echo 'User Details updated successfully.';
        // echo '<script>alert("User updated successfully.");</script>';
        // echo '<script>window.location.href = "usertable.php";</script>';
    } else {
        echo '<script>alert("Error updating user: ' . mysqli_error($db) . '");</script>';
        echo '<script>window.location.href = "usertable.php";</script>';
    }
}
?>
