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

 

}

// Create an instance of the Login class
$login = new Login();

// Call the SessionCheck method to retrieve and store user_id and business_id
$login->SessionCheck();

// Call the GetUserDetails method to display the user details
$login->GetUserDetails();


?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Owner Index</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	

	<style>


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
<main class="second-main">
  <div class="card">
    <h2>Welcome <?php echo $_SESSION["username"]; ?></h2>
  </div>
  <section class="glass">
		<div class="Dashboard">
      
			<center>
				<h1 style="margin-bottom: 30px;  ">Update Profile Details</h1>
			</center>
      <form class="modern-form" action="update_profile.php" method="POST">
  <?php
  require 'connect.php';
  
  if (isset($_SESSION['login'])) {
    $user = $login->GetUserDetails();
  ?>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="user_id" name="user_id" value="<?php echo $user["user_id"]; ?>" required style="display: none;">
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