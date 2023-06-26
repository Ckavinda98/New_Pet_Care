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
  
    // Retrieve the updated username, email, and user type from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $userType = $_POST["user_type"];
  
    // Perform the update query
    $query = "UPDATE user SET username='$username', email='$email', user_type='$userType' WHERE user_id='$userId'";
  
    // Execute the query
    if (mysqli_query($db, $query)) {
        echo 'User updated successfully.';
        // echo '<script>alert("User updated successfully.");</script>';
        // echo '<script>window.location.href = "usertable.php";</script>';
    } else {
        echo '<script>alert("Error updating user: ' . mysqli_error($db) . '");</script>';
        echo '<script>window.location.href = "usertable.php";</script>';
    }
}

?>

