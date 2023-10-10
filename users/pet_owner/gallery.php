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
    @$businessId = $businessIdRow["busniess_id"];

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

// $user_id = $_SESSION["user_id"];
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


    
    .second-main-product{
  position: relative;
  font-family: "Poppins", sans-serif;
  height: 70vh;
  /* background-image: url(images/bgpattern.png);
  background-repeat: no-repeat;
  background-size: cover; */
  /* border: 2px solid black; */
  display: flex;
  align-items: center;
  justify-content: center;
 
  flex-direction: column;
 
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
  width: 250px;
  height: 150px;
  object-fit: cover;
 
  margin-bottom: 10px;
}

.glass h2 {
  font-size: 20px;
  margin-bottom: 10px;
}



/* Additional styling for the container */

.Dashboard {
  width: 300px;
  padding: 20px;
  margin: 10px;
  background-color: white;
}



	</style>
<script>
  function deleteProduct(product_id) {
    if (confirm("Are you sure you want to delete this product?")) {
      // Redirect to delete.php passing the product_id
      window.location.href = "function.php?id=" + product_id;
    }
  }
</script>





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
                    <li><a href="Allservice.php">All Service</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="MyAppointments.php">My Appointments</a></li>
                   
                    <li><a href="MyPrescription.php">My Prescription</a></li>
                    
                    
                    
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



<main class="second-main-product">
  <div class="card">
    <h2>Gallery</h2>
  </div>

  <div class="product-container">
  <?php
include 'connect.php';

// Retrieve the user_id from the query parameters or session
$user_id = $_GET['user_id']; // Assuming you are passing the user_id as a query parameter

// Fetch images from the database based on the user_id
$query = "SELECT * FROM gallery WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Variable to track if any images were displayed
$imageDisplayed = false;

// Loop over the images and generate HTML
while ($image = mysqli_fetch_assoc($result)) {
  $image_id = $image['image_id']; // Fetch the image ID
  $image_path = 'uploads/' . $image['images'];

  // Check if the image file exists
  if (file_exists($image_path)) {
    $imageDisplayed = true;
    ?>
    <section class="glass">
      <div class="Dashboard">
        <img src="<?php echo $image_path; ?>" alt="Image <?php echo $image_id; ?>" />
      </div>
    </section>
    <?php
  }
}

// Check if any images were displayed
if (!$imageDisplayed) {
  ?>
  <section class="glass">
    <div class="Dashboard">
      <p>No images available.</p>
    </div>
  </section>
  <?php
}

// Close the database connection
mysqli_close($conn);
?>

  </div>
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