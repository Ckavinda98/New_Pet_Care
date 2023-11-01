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
  $businessIdQuery = "SELECT groomer_id FROM pet_groomer WHERE user_id = '{$_SESSION["user_id"]}'";
  $businessIdResult = mysqli_query($conn, $businessIdQuery);
  $businessIdRow = mysqli_fetch_assoc($businessIdResult);
  $businessId = isset($businessIdRow["groomer_id"]) ? $businessIdRow["groomer_id"] : null;

  // Store the business_id in the session
  $_SESSION["groomer_id"] = $businessId;

  // Use the retrieved user_id and business_id for further operations
  // Here you can perform any other required actions with the user_id and business_id
}

    // Use the retrieved user_id and business_id for further operations
    // Here you can perform any other required actions with the user_id and business_id
  

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

  public function GetGroomerDetails() {
    global $conn;
    // Retrieve the business details based on the stored business_id
    $businessId = $_SESSION["groomer_id"];
    // Run the query to fetch business details
    $businessQuery = "SELECT * FROM pet_groomer WHERE groomer_id = '$businessId'";
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
$login->GetGroomerDetails();
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Shop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>


    /* Main container styles */
.second-main {
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  align-items: center;
  padding: 20px;
  
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
                    
                    <li><a href="AddgroomerDetails.php">Add Grooming Details</a></li>
                    <li><a href="addimage.php">Add Image</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    
                </ul>
            </nav>
            <div class="buttons">
            <ul class="navbar">
                    
                    <li><a href="../../includes/logout.php">Log out</a></li>
                </ul>
        </div>
    </div>
</header>



<main class="second-main">
<div class="card">
  <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
</div>

 <section class="glass">
		<div class="Dashboard">
      
			<center>
				<h1 style="margin-bottom: 30px;  ">Update Profile Details</h1>
			</center>
      <form class="modern-form1" action="update_profile.php" method="POST">
  <?php
  require 'connect.php';
  
  if (isset($_SESSION['login'])) {
    $user = $login->GetUserDetails();
  ?>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="user_id" name="user_id" value="<?php echo $user["user_id"]; ?>" required required style="display: none;">
      <input type="text" id="username" name="username" value="<?php echo $user["username"]; ?>" required readonly>
      <div id="username-availability"></div> <!-- Display username availability status here -->
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="<?php echo $user["email"]; ?>" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="text" id="password" name="password" value="<?php echo $user["password"]; ?>" required>
    </div>
    <div class="form-group full-width">
      <button type="button" name="submit" class="btn-submit" onclick="updateUser(<?php echo $user["user_id"]; ?>)">Update</button>
    </div>
    <?php
  }
  ?>
</form>

<script>
 function updateUser(userId) {
  console.log('updateUser function called with userId:', userId);
  var username = document.getElementsByName('username')[0].value;
  var email = document.getElementsByName('email')[0].value;
  var password = document.getElementsByName('password')[0].value;
  

  // Perform the update using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'update_profile.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      // Handle the response from the server
      alert(xhr.responseText); // Display a success message or handle any errors
    }
  };

  var params =
    'user_id=' +
    userId +
    '&username=' +
    encodeURIComponent(username) +
    '&email=' +
    encodeURIComponent(email) +
    '&password=' +
    encodeURIComponent(password);

  xhr.send(params);
}



</script>





     

		
	</section>
 </div>

 <section class="glass">
		<div class="Dashboard">
      
			<center>
				<h1 style="margin-bottom: 30px;  ">Update Service Details</h1>
			</center>
      <form class="modern-form" action="update_grooming.php" method="POST" >
      <?php
      if (isset($_SESSION['login'])) {
        $user = $login->GetGroomerDetails();
      ?>
  <div class="form-group">
  <label for="username">Username:</label>
  <input type="text" id="user_id" name="user_id" value="<?php echo $user["user_id"]; ?>" required style="display: none;">
  <input type="text" id="Susername" name="Susername" value="<?php echo isset($user["groomer_name"]) ? $user["groomer_name"] : ''; ?>" <?php echo isset($user["groomer_name"]) ? 'required' : ''; ?>>

  </div>
  <div class="form-group">
  <label for="address">Address:</label>
  <input type="text" id="address" name="address" value="<?php echo isset($user["address"]) ? $user["address"] : ''; ?>" <?php echo isset($user["address"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="city">City:</label>
  <input type="text" id="city" name="city" value="<?php echo isset($user["city"]) ? $user["city"] : ''; ?>" <?php echo isset($user["city"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="postal_code">Postal Code:</label>
  <input type="text" id="postal_code" name="postal_code" value="<?php echo isset($user["postal_code"]) ? $user["postal_code"] : ''; ?>" <?php echo isset($user["postal_code"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="contact_number">Contact Number:</label>
  <input type="text" id="contact_number" name="contact_number" value="<?php echo isset($user["contact_number"]) ? $user["contact_number"] : ''; ?>" <?php echo isset($user["contact_number"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="email">Email:</label>
  <input type="email" id="Semail" name="Semail" value="<?php echo isset($user["email"]) ? $user["email"] : ''; ?>" <?php echo isset($user["email"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="website">Website:</label>
  <input type="text" id="website" name="website" value="<?php echo isset($user["website"]) ? $user["website"] : ''; ?>">
</div>
<div class="form-group">
  <label for="description">Description:</label>
  <textarea id="description" name="description"><?php echo isset($user["description"]) ? $user["description"] : ''; ?></textarea>
</div>
<div class="form-group">
  <label for="latitude">Latitude</label>
  <input type="text" name="latitude" id="latitude" value="<?php echo isset($user["latitude"]) ? $user["latitude"] : ''; ?>" <?php echo isset($user["latitude"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="longitude">Longitude</label>
  <input type="text" name="longitude" id="longitude" value="<?php echo isset($user["longitude"]) ? $user["longitude"] : ''; ?>" <?php echo isset($user["longitude"]) ? 'required' : ''; ?>>
</div>
<div class="form-group">
  <label for="opening_hours">Available Time:</label>
  <input type="time" id="opening_time" name="opening_time" value="<?php echo isset($user["opening_time"]) ? $user["opening_time"] : ''; ?>">
</div>
<div class="form-group">
  <label for="opening_hours">Closing Time:</label>
  <input type="time" id="closing_time" name="closing_time" value="<?php echo isset($user["closing_time"]) ? $user["closing_time"] : ''; ?>">
</div>

  <div class="form-group full-width">
  <button type="button" name="submit" class="btn-submit" onclick="updateService(<?php echo $user["user_id"]; ?>)">Update</button>
  </div>
  <?php
       } else {
        // Handle the case when user data is not available
        echo "User data is not available. Please add your details.";
      }
    
      ?>
</form>

<script>
  function updateService(userId) {
    console.log('updateService function called with userId:', userId);
    var username = document.getElementById('Susername').value;
    var email = document.getElementById('Semail').value;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;
    var postalCode = document.getElementById('postal_code').value;
    var contactNumber = document.getElementById('contact_number').value;
    var website = document.getElementById('website').value;
    var description = document.getElementById('description').value;
    var latitude = document.getElementById('latitude').value;
    var longitude = document.getElementById('longitude').value;
    var openingTime = document.getElementById('opening_time').value;
    var closingTime = document.getElementById('closing_time').value;

    // Perform the update using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_grooming.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        // Handle the response from the server
        alert(xhr.responseText); // Display a success message or handle any errors
      }
    };

    var params =
      'user_id=' +
      userId +
      '&username=' +
      encodeURIComponent(username) +
      '&email=' +
      encodeURIComponent(email) +
      '&address=' +
      encodeURIComponent(address) +
      '&city=' +
      encodeURIComponent(city) +
      '&postal_code=' +
      encodeURIComponent(postalCode) +
      '&contact_number=' +
      encodeURIComponent(contactNumber) +
      '&website=' +
      encodeURIComponent(website) +
      '&description=' +
      encodeURIComponent(description) +
      '&latitude=' +
      encodeURIComponent(latitude) +
      '&longitude=' +
      encodeURIComponent(longitude) +
      '&opening_time=' +
      encodeURIComponent(openingTime) +
      '&closing_time=' +
      encodeURIComponent(closingTime);

    xhr.send(params);
  } 
</script>



     
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
    <a href="https://www.facebook.com"><img src="../../images/FB.png" width="40px" height="40px" alt=""></a>
<a href="https://www.twitter.com"><img src="../../images/TW.png" width="40px" height="40px" alt=""></a>
<a href="https://www.instagram.com"><img src="../../images/IG.png" width="40px" height="40px" alt=""></a>
<a href="https://www.linkedin.com"><img src="../../images/LK.png" width="40px" height="40px" alt=""></a>

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