<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user_id parameter is set
    if (isset($_POST["appointment_id"]) && !empty($_POST["appointment_id"])) {
        $user_id = $_POST["appointment_id"];

        // Prevent deleting the logged-in user
        if (isset($_SESSION["appointment_id"]) && $_SESSION["appointment_id"] == $user_id) {
            echo "You cannot delete the logged-in user.";
            exit();
        }

        // Delete the user from the database
        $query = "DELETE FROM 	appointments WHERE appointment_id = '$user_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "User with ID $user_id has been deleted successfully.";
        } else {
            echo "Error deleting user with ID $user_id: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid request. User ID is missing.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
