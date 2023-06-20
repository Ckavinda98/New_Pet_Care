<?php
include 'connect.php';

class Login {
  public function LoginSystem() {
    session_start(); // Starting Session
    $error = ''; // Variable To Store Error Message

    if (!isset($_POST['submit'])) {
      if (empty($_POST['login']) || empty($_POST['password'])) {
        $_SESSION['successMessage'] = "Login Unsuccessful.";
        echo '<script>alert("Check Your Username or Password!");</script>';
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
      }
    } else {
      include 'connect.php';
      // Define $username and $password
      $username = $_POST['login'];
      $password = ($_POST['password']);
      // SQL query to fetch information of registered users and find user match.
      $query = "SELECT username, password, user_type, user_id FROM user WHERE username=? AND password=? LIMIT 1";
      // To protect against MySQL injection for security purposes
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ss", $username, $password);
      $stmt->execute();
      $stmt->bind_result($username, $password, $user_type, $user_id);
      $stmt->store_result();

      if ($stmt->fetch()) { // Fetch the contents of the row
        $_SESSION['login'] = $username; // Initializing Session
        $_SESSION['user_type'] = $user_type;
        $_SESSION['user_id'] = $user_id; // Storing user_id in session
      }

      mysqli_close($conn); // Closing Connection
    }
  }

  public function SessionVerify() {
    if (isset($_SESSION['login'])) {
      header("location: includes/checkuser.php"); // Check user session and role
    }
  }

  public function SessionCheck() {
    global $conn;
    
    // Storing Session
    $user_check = $_SESSION['login'];

    // SQL Query To Fetch Complete Information Of User
    $query = "SELECT * FROM user WHERE username = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $_SESSION["username"] = $row["username"];
    $_SESSION["user_type"] = $row["user_type"];
    $_SESSION["password"] = $row["password"];
    // No need to fetch user_id as it is already stored during login
  }



  public function UserType() {
    if ($_SESSION["user_type"] == "Pet Owner") {
     
      echo '<script>alert("Login successful.");</script>';
      echo '<script>window.location.href = "../users/pet_owner/index.php";</script>';
    }
    else if ($_SESSION["user_type"] == "admin") {
      
      echo '<script>alert("Login successful.");</script>';
      echo '<script>window.location.href = "../users/admin/index.php";</script>';
    } 
     else if ($_SESSION["user_type"] == "Veterinarian") {
      
      echo '<script>alert("Login successful.");</script>';
      echo '<script>window.location.href = "../users/Veterinarian/index.php";</script>';
    } 
        else if ($_SESSION["user_type"] == "Pharmacist") {
      
      echo '<script>alert("Login successful.");</script>';
      echo '<script>window.location.href = "../users/Pharmacist/index.php";</script>';
    } 
    else if ($_SESSION["user_type"] == "Pet Shop") {
        
        echo '<script>alert("Login successful.");</script>';
        echo '<script>window.location.href = "../users/pet_shop/index.php";</script>';
      }
      else if ($_SESSION["user_type"] == "Pet Grooming") {
       
        echo '<script>alert("Login successful.");</script>';
        echo '<script>window.location.href = "../users/pet_groomer/index.php";</script>';
      }
      else if ($_SESSION["user_type"] == "Pet DayCare") {
       
        echo '<script>alert("Login successful, but business type is not set.");</script>';
        echo '<script>window.location.href = "../users/Pet_Day_Care/index.php";</script>';
      }
      else if ($_SESSION["user_type"] == "Serivce Provider") {
       
        echo '<script>alert("Login successful, but business type is not set.");</script>';
        echo '<script>window.location.href = "../users/service_provider/index.php";</script>';
      }
        else {
          echo '<script>alert("Invalid Username or Password");</script>';
        echo '<script>window.location.href = "../login.php";</script>';
       }
      }
    

    }


class UserFunctions{
 
  public function UserIDI() {
    $UserIDI = $_SESSION["user_id"];
    echo $UserIDI;
  }
}

