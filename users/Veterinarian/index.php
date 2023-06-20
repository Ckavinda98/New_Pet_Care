<?php
session_start();
include 'connect.php';

class Login {
  // ...
  
  public function SessionCheck() {
    global $conn;
    
    // Storing Session
    $user_check = $_SESSION['login'];

    // SQL Query To Fetch Complete Information Of User
    $query = "SELECT * FROM user WHERE username = '$user_check'";
    $ses_sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($ses_sql);
    $_SESSION["user_id"] = $row["user_id"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["user_type"] = $row["user_type"];
    $_SESSION["password"] = $row["password"];

    // Retrieve the business_id from the business_details table
    $businessIdQuery = "SELECT busniess_id FROM busniess_details WHERE user_id = '{$_SESSION["user_id"]}'";
    $businessIdResult = mysqli_query($conn, $businessIdQuery);
    $businessIdRow = mysqli_fetch_assoc($businessIdResult);
    $businessId = $businessIdRow["busniess_id"];

    // Store the business_id in the session
    $_SESSION["business_id"] = $businessId;

    // Use the retrieved user_id and business_id for further operations
    // Here you can perform any other required actions with the user_id and business_id
  }

  public function GetUserDetails() {
    global $conn;
    // Retrieve the user details based on the stored user_id
    $userId = $_SESSION["user_id"];
    // Run the query to fetch user details
    $userQuery = "SELECT * FROM user WHERE user_id = '$userId'";
    $userResult = mysqli_query($conn, $userQuery);
    $user = mysqli_fetch_assoc($userResult);

    // Return the user details
    return $user;
  }

  public function GetBusinessDetails() {
    global $conn;
    // Retrieve the business details based on the stored business_id
    $businessId = $_SESSION["business_id"];
    // Run the query to fetch business details
    $businessQuery = "SELECT * FROM busniess_details WHERE busniess_id = '$businessId'";
    $businessResult = mysqli_query($conn, $businessQuery);
    $business = mysqli_fetch_assoc($businessResult);

    // Return the business details
    return $business;
  }

}

// Create an instance of the Login class
$login = new Login();

// Call the SessionCheck method to retrieve and store user_id and business_id
$login->SessionCheck();

// Call the GetUserDetails method to display the user details
$login->GetUserDetails();

// Call the GetBusinessDetails method to display the business details
$login->GetBusinessDetails();
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>

body {
  background-color: #f8f8f8;
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

    /* Main container styles */
.second-main {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 20px;
  
}

/* Glass styles */
.glass-3,
.glass-4 {
  background-color: white;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  text-align: center;
}

/* Dashboard styles */
.Dashboard {
  color: #333;
}

/* Heading styles */
.Dashboard h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

/* User details styles */
.glass-3 p {
  margin-bottom: 10px;
}

/* Business details styles */
.glass-4 p {
  margin-bottom: 10px;
}

/* Price styles */
.price {
  font-weight: bold;
}

/* Additional styles */
.container {
  max-width: 1200px;
  margin: 0 auto;
}

    
    .second-main-product{
  position: relative;
  font-family: "Poppins", sans-serif;

  /* background-image: url(images/bgpattern.png);
  background-repeat: no-repeat;
  background-size: cover; */
  /* border: 2px solid black; */
  display: flex;
  align-items: center;
  justify-content: center;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  text-align: center;
}

.product-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  
}

    .card {
  display: flex;
  margin-top: 30px;
  margin-bottom: 20px;
  justify-content: center;
  align-items: center;
  background-color: #9f2485;;
  padding: 10px;
 
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card h2 {
  font-size: 24px;
  margin: 0;
  color: white;
}




	.glass {
  
  
    background-color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  margin: 20px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


.glass img {
  width: 150px;
  height: 150px;
  object-fit: cover;
  border-radius: 50%;
  margin-bottom: 10px;
}

.glass h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

.glass p {
  font-size: 14px;
  margin-bottom: 5px;
}

.glass p.price {
  font-weight: bold;
}

/* Additional styling for the container */

.Dashboard {
  width: 300px;
  padding: 20px;
  margin: 10px;
  background-color: white;
}

.price {
  font-weight: bold;
  color: red;
}

	</style>

</head>
<body>
<header>
    <div class="header">
        <div class="logo-container">
            <img src="../../images/logo2.png" class="logoimg" width="125px" height="70px" alt="">
        </div>
        <div class="navbar-buttons">
            <nav>
            <ul class="navbar">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="AddVeterinarianDetails.php">Veterinarian Details</a></li>
                   
                    <li><a href="VetAppointment.php">Appointments</a></li>
                    
                    
                </ul>
            </nav>
            <div class="buttons">
            <ul class="navbar">
                    <!-- <li><a href="register.php">Sing up</a></li> -->
                    <li><a href="../../includes/logout.php">Log out</a></li>
                </ul>
        </div>
    </div>
</header>
<main class="second-main">
<div class="card">
  <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
</div>
  <section class="glass-3">
    <div class="Dashboard">
      <!-- Display the user details here -->
      <?php
      // Call the GetUserDetails method only if the user is logged in
      if (isset($_SESSION['login'])) {
        $user = $login->GetUserDetails();
        // Display the user details
        echo "Username: " . $user["username"] . "<br>";
        echo "User Type: " . $user["user_type"] . "<br>";
        // Add any additional user details you want to display
      }
      ?>
    </div>
  </section>

  <section class="glass-4">
    <div class="Dashboard">
      <!-- Display the business details here -->
      <?php
      // Call the GetBusinessDetails method only if the user is logged in
      if (isset($_SESSION['login'])) {
        $business = $login->GetBusinessDetails();
        // Display the business details
        echo "Business Name: " . $business["name"] . "<br>";
        echo "Address: " . $business["address"] . "<br>";
        // Add any additional business details you want to display
      }
      ?>
    </div>
  </section>
</main>












<footer>
	<div class="footer">
		<div class="container">
			<div class="row">
				<div class="col-1">
				<h4>Hot Line</h4>	
				<ul>
			<li>0112244455</li>
			<li>0112244455</li>
            <li>0112244455</li>
			</ul>
        </div>
				<div class="col-2">
				<h4>Head Office</h4>	
				<ul>
			<li>No. 36 High way Road</li>
			<li> Colombo</li>
			<li>www.Pet-Care.com</li>
			</ul>
			</div>
				<div class="col-3">
                <h4 style="text-align:center;">Follow Us</h4>
		<div class="colo-3list">
        <a href="www.facebook.com">	<img src="../../images/FB.png" width="40px" height="40px" alt=""></a>
		<a href="www.twitter.com">	    <img src="../../images/TW.png" width="40px" height="40px" alt=""></a>
		<a href="www.instagram.com">	<img src="../../images/IG.png" width="40px" height="40px" alt=""></a>
		<a href="www.lindkin.com"> 	<img src="../../images/LK.png" width="40px" height="40px" alt=""></a>
        </div>
                </div>
			</div>
			<hr>
        <p class="copyright">- @All Right Reserved Pet Care Insuarance -</p>
		</div>
	</div>
</footer>

</body>
</html>