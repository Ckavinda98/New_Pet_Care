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
    $username = $_POST["vet_name"][$userId];
    $email = $_POST["email"][$userId];
    $address = $_POST["address"][$userId];
    $city = $_POST["city"][$userId];
    $postalCode = $_POST["postal_code"][$userId];
    $contactNumber = $_POST["contact_number"][$userId];
    $website = $_POST["website"][$userId];
    $description = $_POST["description"][$userId];
    $latitude = $_POST["latitude"][$userId];
    $longitude = $_POST["longitude"][$userId];
  
    // Perform the update query
    $query = "UPDATE veterinarian SET vet_name='$username', email='$email', address='$address', city='$city', postal_code='$postalCode', contact_number='$contactNumber', website='$website', description='$description', latitude='$latitude', longitude='$longitude' WHERE user_id='$userId'";
  
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
